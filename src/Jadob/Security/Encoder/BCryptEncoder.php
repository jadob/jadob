<?php
declare(strict_types=1);

namespace Jadob\Security\Encoder;

use RuntimeException;
use function password_hash;
use function password_verify;
use const PASSWORD_BCRYPT;

/**
 * @author  pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
class BCryptEncoder implements PasswordEncoderInterface
{
    /**
     * @var int
     */
    protected int $cost;

    /**
     * BcryptEncoder constructor.
     *
     * @param int $cost
     * @throws RuntimeException
     */
    public function __construct(int $cost)
    {

        if ($cost < 4 || $cost > 31) {
            throw new RuntimeException('Invalid password cost passed');
        }

        $this->cost = $cost;
    }

    /**
     * @param string $raw
     * @param string $salt
     *
     * @return string
     */
    public function encode($raw, $salt = null): string
    {
        $hash = password_hash(
            $raw,
            PASSWORD_BCRYPT, [
                'cost' => $this->cost
            ]
        );

        if ($hash === false) {
            throw new \RuntimeException('Unable to hash given phrase.');
        }

        if ($hash === null) {
            throw new \RuntimeException('Unable to hash given phrase as algorithm may be invalid.');
        }

        return $hash;
    }

    /**
     * @param string $raw
     * @param string $hash
     * @return bool
     */
    public function compare($raw, $hash)
    {
        return password_verify($raw, $hash);
    }
}