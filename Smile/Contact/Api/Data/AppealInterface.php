<?php

/**
 * Smile appeal interface.
 *
 * @author    Dmytro Kohut <dmkoh@smile.fr>
 * @copyright 2020 Smile
 */

declare(strict_types=1);

namespace Smile\Contact\Api\Data;

/**
 * Interface AppealInterface
 *
 * @package Smile\Contact\Api\Data
 */
interface AppealInterface
{
    /**
     * Table name.
     */
    const TABLE_NAME = 'smile_contactus_appeal';

    /**#@+
     * Constants defined for keys of data array.
     */
    const ID          = 'id';
    const NAME        = 'name';
    const TELEPHONE   = 'telephone';
    const EMAIL       = 'email';
    const COMMENT     = 'comment';
    const ANSWER      = 'answer';
    const STATUS      = 'status';
    const CREATED_AT  = 'created_at';
    const UPDATED_AT  = 'updated_at';
    /**#@-*/

    /**
     * Get ID.
     *
     * @return int
     */
    public function getAppealId(): int;

    /**
     * Get name.
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Get telephone.
     *
     * @return string
     */
    public function getTelephone(): string;

    /**
     * Get email.
     *
     * @return string
     */
    public function getEmail(): string;

    /**
     * Get comment.
     *
     * @return string
     */
    public function getComment(): string;

    /**
     * Get answer.
     *
     * @return string|null
     */
    public function getAnswer(): ?string;

    /**
     * Get status.
     *
     * @return bool
     */
    public function getStatus(): bool;

    /**
     * Get creation time.
     *
     * @return string
     */
    public function getCreatedAt(): string;

    /**
     * Get update time.
     *
     * @return string
     */
    public function getUpdatedAt(): string;

    /**
     * Set ID.
     *
     * @param int $id
     *
     * @return AppealInterface
     */
    public function setAppealId(int $id): AppealInterface;

    /**
     * Set name.
     *
     * @param string $name
     *
     * @return AppealInterface
     */
    public function setName(string $name): AppealInterface;

    /**
     * Set telephone.
     *
     * @param string $telephone
     *
     * @return AppealInterface
     */
    public function setTelephone(string $telephone): AppealInterface;

    /**
     * Set email.
     *
     * @param string $email
     *
     * @return AppealInterface
     */
    public function setEmail(string $email): AppealInterface;

    /**
     * Set comment.
     *
     * @param string $comment
     *
     * @return AppealInterface
     */
    public function setComment(string $comment): AppealInterface;

    /**
     * Set answer.
     *
     * @param string $answer
     *
     * @return AppealInterface
     */
    public function setAnswer(string $answer): AppealInterface;

    /**
     * Set appeal status.
     *
     * @param bool $appealStatus
     *
     * @return AppealInterface
     */
    public function setStatus(bool $appealStatus): AppealInterface;

    /**
     * Set creation time.
     *
     * @param string $creationTime
     *
     * @return AppealInterface
     */
    public function setCreatedAt(string $creationTime): AppealInterface;

    /**
     * Set update time.
     *
     * @param string $updateTime
     *
     * @return AppealInterface
     */
    public function setUpdatedAt(string $updateTime): AppealInterface;
}
