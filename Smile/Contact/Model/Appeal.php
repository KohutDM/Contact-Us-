<?php

/**
 * Contact appeal model.
 *
 * @author    Dmytro Kohut <dmkoh@smile.fr>
 * @copyright 2020 Smile
 */

declare(strict_types=1);

namespace Smile\Contact\Model;

use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;
use Smile\Contact\Api\Data\AppealInterface;

/**
 * Class Appeal
 *
 * @package Smile\Contact\Model
 */
class Appeal extends AbstractModel implements AppealInterface, IdentityInterface
{
    /**#@+
     * Appeal's Statuses.
     */
    const STATUS_NEW = 1;
    const STATUS_ANSWERED = 0;
    /**#@-*/

    /**
     * Smile appeal cache tag.
     */
    const CACHE_TAG = 'smile_contactus_appeal';

    /**
     * Cache tag.
     *
     * @var string
     */
    public $cacheTag = 'smile_contactus_appeal';

    /**
     * Prefix of model events names.
     *
     * @var string
     */
    public $eventPrefix = 'smile_contactus_appeal';

    /**
     * Appeal construct.
     *
     * @return void
     */
    public function _construct(): void
    {
        $this->_init('Smile\Contact\Model\ResourceModel\Appeal');
    }

    /**
     * Get identities.
     *
     * @return array
     */
    public function getIdentities(): array
    {
        return [self::CACHE_TAG . '_' . $this->getAppealId()];
    }

    /**
     * Retrieve appeal id.
     *
     * @return int
     */
    public function getAppealId(): int
    {
        return (int)$this->getData(self::ID);
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->getData(self::NAME);
    }

    /**
     * Get telephone.
     *
     * @return string
     */
    public function getTelephone(): string
    {
        return $this->getData(self::TELEPHONE);
    }

    /**
     * Get email.
     *
     * @return string
     */
    public function getEmail(): string
    {
        return $this->getData(self::EMAIL);
    }

    /**
     * Get comment.
     *
     * @return string
     */
    public function getComment(): string
    {
        return $this->getData(self::COMMENT);
    }

    /**
     * Get answer.
     *
     * @return string|null
     */
    public function getAnswer(): ?string
    {
        return $this->getData(self::ANSWER);
    }

    /**
     * Get status.
     *
     * @return bool
     */
    public function getStatus(): bool
    {
        return (bool)$this->getData(self::STATUS);
    }

    /**
     * Get creation time.
     *
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->getData(self::CREATED_AT);
    }

    /**
     * Get update time.
     *
     * @return string
     */
    public function getUpdatedAt(): string
    {
        return $this->getData(self::UPDATED_AT);
    }

    /**
     * Set ID.
     *
     * @param int $id
     *
     * @return AppealInterface
     */
    public function setAppealId(int $id): AppealInterface
    {
        return $this->setData(self::ID, $id);
    }

    /**
     * Set name.
     *
     * @param string $name
     *
     * @return AppealInterface
     */
    public function setName($name): AppealInterface
    {
        return $this->setData(self::NAME, $name);
    }

    /**
     * Set telephone.
     *
     * @param string $telephone
     *
     * @return AppealInterface
     */
    public function setTelephone(string $telephone): AppealInterface
    {
        return $this->setData(self::TELEPHONE, $telephone);
    }

    /**
     * Set email.
     *
     * @param string $email
     *
     * @return AppealInterface
     */
    public function setEmail(string $email): AppealInterface
    {
        return $this->setData(self::EMAIL, $email);
    }

    /**
     * Set comment.
     *
     * @param string $comment
     *
     * @return AppealInterface
     */
    public function setComment(string $comment): AppealInterface
    {
        return $this->setData(self::COMMENT, $comment);
    }

    /**
     * Set answer.
     *
     * @param string $answer
     *
     * @return AppealInterface
     */
    public function setAnswer(string $answer): AppealInterface
    {
        return $this->setData(self::ANSWER, $answer);
    }

    /**
     * Set appeal status.
     *
     * @param bool $appealStatus
     *
     * @return AppealInterface
     */
    public function setStatus(bool $appealStatus): AppealInterface
    {
        return $this->setData(self::STATUS, $appealStatus);
    }

    /**
     * Set creation time.
     *
     * @param string $creationTime
     *
     * @return AppealInterface
     */
    public function setCreatedAt(string $creationTime): AppealInterface
    {
        return $this->setData(self::CREATED_AT, $creationTime);
    }

    /**
     * Set update time.
     *
     * @param string $updateTime
     *
     * @return AppealInterface
     */
    public function setUpdatedAt(string $updateTime): AppealInterface
    {
        return $this->setData(self::UPDATED_AT, $updateTime);
    }

    /**
     * Prepare appeal's statuses.
     *
     * @return array
     */
    public function getAvailableStatuses(): array
    {
        return [self::STATUS_NEW => __('New'), self::STATUS_ANSWERED => __('Answered')];
    }
}
