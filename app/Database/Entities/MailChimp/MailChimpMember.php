<?php
declare(strict_types=1);

namespace App\Database\Entities\MailChimp;

use Doctrine\ORM\Mapping as ORM;
use EoneoPay\Utils\Str;

/**
 * @ORM\Entity()
 */
class MailChimpMember extends MailChimpEntity
{
    /**
     * @ORM\Id()
     * @ORM\Column(name="list_id", type="guid")
     * @ORM\GeneratedValue(strategy="UUID")
     *
     * @var string
     */
    private $listId;
  
    /**
     * @ORM\Id()
     * @ORM\Column(name="id", type="guid")
     * @ORM\GeneratedValue(strategy="UUID")
     *
     * @var string
     */
    private $memberId;

    /**
     * @ORM\Column(name="mail_chimp_id", type="string", nullable=true)
     *
     * @var string
     */
    private $mailChimpId;

    /**
     * @ORM\Column(name="email_address", type="string")
     *
     * @var string
     */
    private $emailAddress;

    /**
     * @ORM\Column(name="email_type", type="string")
     *
     * @var string
     */
    private $emailType;

    /**
     * @ORM\Column(name="status", type="string")
     *
     * @var string
     */
    private $status;

    /**
     * @ORM\Column(name="merge_fields", type="string")
     *
     * @var object
     */
    
    private $mergeFields;

    /**
     * @ORM\Column(name="interests", type="string")
     *
     * @var string
     */
    private $interests;

    /**
     * @ORM\Column(name="language", type="string")
     *
     * @var string
     */
    private $language;

    /**
     * @ORM\Column(name="vip", type="string")
     *
     * @var string
     */
    private $vip;

    /**
     * @ORM\Column(name="location", type="object")
     *
     * @var object
     */
    private $location;

    /**
     * @ORM\Column(name="marketing_permissions", type="array")
     *
     * @var array
     */
    private $marketingPermissions;

    /**
     * @ORM\Column(name="ip_signup", type="string")
     *
     * @var string
     */
    private $ipSignup;

    /**
     * @ORM\Column(name="timestamp_signup", type="string")
     *
     * @var string
     */
    private $timestampSignup;

    /**
     * @ORM\Column(name="ip_signup", type="string")
     *
     * @var string
     */
    private $ipOpt;

    /**
     * @ORM\Column(name="timestamp_opt", type="string")
     *
     * @var string
     */
    private $timestampOpt;

    /**
     * @ORM\Column(name="tags", type="string")
     *
     * @var string
     */
    private $tags;


    /**
     * Get id.
     *
     * @return null|string
     */
    public function memberId(): ?string
    {
        return $this->memberId;
    }

    /**
     * Get mailchimp id of the list.
     *
     * @return null|string
     */
    public function getMailChimpId(): ?string
    {
        return $this->mailChimpId;
    }

    /**
     * Get validation rules for mailchimp entity.
     *
     * @return array
     */
    public function getValidationRules(): array
    {
        return [
            'list_id' => 'required|string',
            'email_address' => 'required|email|string',
            'email_type' => 'required|string',
            'merge_fields' => 'nullable|array',
            'interests' => 'nullable|array',
            'language' => 'nullable|string',
            'vip' => 'required|string',
            'location.latitude' => 'nullable|string',
            'location.longitude' => 'nullable|string',
            'marketing_permissions' => 'nullable|array',
            'ip_signup' => 'nullable|string',
            'timestamp_signup' => 'required|string',
            'ip_opt' => 'nullable|string',
            'timestamp_opt' => 'nullable|string',
            'tags' => 'nullable|array'
        ];
    }

    /**
     * Set campaign defaults.
     *
     * @param array $emailAddress
     *
     * @return MailChimpMember
     */
    public function setEmailAddress(string $emailAddress): MailChimpMemberMember
    {
        $this->emailAddress = $emailAddress;

        return $this;
    }

    /**
     * Set campaign defaults.
     *
     * @param array $emailType
     *
     * @return MailChimpMember
     */
    public function setEmailType(string $emailType): MailChimpMemberMember
    {
        $this->emailType = $emailType;

        return $this;
    }

    /**
     * Set campaign defaults.
     *
     * @param array $mergeFields
     *
     * @return MailChimpMember
     */
    public function setMergeFields(array $mergeFields): MailChimpMemberMember
    {
        $this->mergeFields = $mergeFields;

        return $this;
    }

     /**
     * Set campaign defaults.
     *
     * @param string $language
     *
     * @return MailChimpMember
     */
    public function setLanguage(string $language): MailChimpMemberMember
    {
        $this->language = $language;

        return $this;
    }

     /**
     * Set campaign defaults.
     *
     * @param array $interests
     *
     * @return MailChimpMember
     */
    public function setInterests(array $interests): MailChimpMemberMember
    {
        $this->interests = $interests;

        return $this;
    }

     /**
     * Set campaign defaults.
     *
     * @param string $interests
     *
     * @return MailChimpMember
     */
    public function setVip(string $vip): MailChimpMemberMember
    {
        $this->vip = $vip;

        return $this;
    }

     /**
     * Set campaign defaults.
     *
     * @param array $location
     *
     * @return MailChimpMember
     */
    public function setLocation(array $location): MailChimpMemberMember
    {
        $this->location = $location;

        return $this;
    }

     /**
     * Set campaign defaults.
     *
     * @param array $interests
     *
     * @return MailChimpMember
     */
    public function setMarketingPermissions(array $marketingPermissions): MailChimpMemberMember
    {
        $this->marketingPermissions = $marketingPermissions;

        return $this;
    }

     /**
     * Set campaign defaults.
     *
     * @param string $ipSignup
     *
     * @return MailChimpMember
     */
    public function setIpSignup(string $ipSignup): MailChimpMemberMember
    {
        $this->ipSignup = $ipSignup;

        return $this;
    }

     /**
     * Set campaign defaults.
     *
     * @param string $timestampSignup
     *
     * @return MailChimpMember
     */
    public function setTimestampSignup(string $timestampSignup): MailChimpMemberMember
    {
        $this->timestampSignup = $timestampSignup;

        return $this;
    }

    /**
     * Set campaign defaults.
     *
     * @param string $ipOpt
     *
     * @return MailChimpMember
     */
    public function setIpOpt(string $ipOpt): MailChimpMemberMember
    {
        $this->ipOpt = $ipOpt;

        return $this;
    }

    /**
     * Set campaign defaults.
     *
     * @param string $timestampOpt
     *
     * @return MailChimpMember
     */
    public function setTimestampOpt(string $timestampOpt): MailChimpMemberMember
    {
        $this->timestampOpt = $timestampOpt;

        return $this;
    }

    /**
     * Set campaign defaults.
     *
     * @param string $timestampOpt
     *
     * @return MailChimpMember
     */
    public function setTags(string $tags): MailChimpMemberMember
    {
        $this->tags = $tags;

        return $this;
    }

    /**
     * Get array representation of entity.
     *
     * @return array
     */
    public function toArray(): array
    {
        $array = [];
        $str = new Str();

        foreach (\get_object_vars($this) as $property => $value) {
            $array[$str->snake($property)] = $value;
        }

        return $array;
    }
}
