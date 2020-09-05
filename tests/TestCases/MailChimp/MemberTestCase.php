<?php
declare(strict_types=1);

namespace Tests\App\TestCases\MailChimp;

use App\Database\Entities\MailChimp\MailChimpList;
use Illuminate\Http\JsonResponse;
use Mailchimp\Mailchimp;
use Mockery;
use Mockery\MockInterface;
use Tests\App\TestCases\WithDatabaseTestCase;

abstract class MemberTestCase extends WithDatabaseTestCase
{
    protected const MAILCHIMP_EXCEPTION_MESSAGE = 'MailChimp exception';

    /**
     * @var array
     */
    protected $createdMemberIds = [];

    /**
     * @var array
     */
    protected static $memberData = [
        'list_id' => '',
        'email_address' => 'ana@ana.com',
        'email_type' => 'sale',
        'merge_fields' => [
            'email_address',
            'email_type',
            'timestamp_opt'
        ],
        'interests' => [
            'sports',
            'music'
        ],
        'language' => 'en',
        'vip' => true,
        'location.latitude' => '14.730300',
        'location.longitude' => '121.138415',
        'marketing_permissions' => [
            'write'
        ],
        'ip_signup' => '192.168.0.10',
        'timestamp_signup' => '2020-09-01T14:15:22Z',
        'ip_opt' => '192.168.0.10',
        'timestamp_opt' => '2020-09-05T14:15:22Z',
        'tags' => [
            'campaign1',
            'campaign2',
            'campaign3',
        ]
    ];

    /**
     * @var array
     */
    protected static $notRequired = [
        'merge_fields',
        'interests',
        'language',
        'location.latitude',
        'location.longitude',
        'marketing_permissions',
        'ip_signup',
        'ip_opt',
        'timestamp_opt',
        'tags',

    ];

    /**
     * Call MailChimp to delete lists created during test.
     *
     * @return void
     */
    public function tearDown(): void
    {
        /** @var Mailchimp $mailChimp */
        $mailChimp = $this->app->make(Mailchimp::class);

        foreach ($this->createdMemberIds as $memberId) {
            // Delete member on MailChimp after test
            $mailChimp->delete(\sprintf('members/%s', $memberId));
        }

        parent::tearDown();
    }

    /**
     * Asserts error response when member not found.
     *
     * @param string $memberId
     *
     * @return void
     */
    protected function assertMemberNotFoundResponse(string $memberId): void
    {
        $content = \json_decode($this->response->content(), true);

        $this->assertResponseStatus(404);
        self::assertArrayHasKey('message', $content);
        self::assertEquals(\sprintf('MailChimpMember[%s] not found', $memberId), $content['message']);
    }

    /**
     * Asserts error response when MailChimp exception is thrown.
     *
     * @param \Illuminate\Http\JsonResponse $response
     *
     * @return void
     */
    protected function assertMailChimpExceptionResponse(JsonResponse $response): void
    {
        $content = \json_decode($response->content(), true);

        self::assertEquals(400, $response->getStatusCode());
        self::assertArrayHasKey('message', $content);
        self::assertEquals(self::MAILCHIMP_EXCEPTION_MESSAGE, $content['message']);
    }

    /**
     * Create MailChimp list into database.
     *
     * @param array $data
     *
     * @return \App\Database\Entities\MailChimp\MailChimpList
     */
    protected function createMember(array $data): MailChimpMember
    {
        $member = new MailChimpMember($data);

        $this->entityManager->persist($member);
        $this->entityManager->flush();

        return $member;
    }

    /**
     * Returns mock of MailChimp to trow exception when requesting their API.
     *
     * @param string $method
     *
     * @return \Mockery\MockInterface
     *
     * @SuppressWarnings(PHPMD.StaticAccess) Mockery requires static access to mock()
     */
    protected function mockMailChimpForException(string $method): MockInterface
    {
        $mailChimp = Mockery::mock(Mailchimp::class);

        $mailChimp
            ->shouldReceive($method)
            ->once()
            ->withArgs(function (string $method, ?array $options = null) {
                return !empty($method) && (null === $options || \is_array($options));
            })
            ->andThrow(new \Exception(self::MAILCHIMP_EXCEPTION_MESSAGE));

        return $mailChimp;
    }
}
