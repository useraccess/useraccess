<?php

use \PHPUnit\Framework\TestCase;

use \PragmaPHP\UserAccess\Entry\User;
use \PragmaPHP\UserAccess\Util\Password;

class UserTest extends TestCase {

    public function test() {
        $user = new User('userid1');
        $this->assertNotEmpty($user);
        $this->assertEquals('userid1', $user->getUniqueName());
        $userAttributes = $user->getAttributes();
        $this->assertEquals('userid1', $userAttributes['uniqueName']);
        $user->setDisplayName('User 1');
        $this->assertEquals('User 1', $user->getDisplayName());
        $user->setEmail('userid1.test@test.com');
        $this->assertEquals('userid1.test@test.com', $user->getEmail());
        $user->setActive(false);
        $this->assertFalse($user->isActive());
        $user->setActive(true);
        $this->assertTrue($user->isActive());
        $user->addRole('Everyone');
        $this->assertTrue($user->hasRole('Everyone'));
        $user->addRole('Administrator');
        $user->addRole('Guests');
        $this->assertTrue($user->hasRole('Everyone'));
        $this->assertTrue($user->hasRole('Administrator'));
        $user->removeRole('Administrator');
        $this->assertTrue($user->hasRole('Everyone'));
        $this->assertFalse($user->hasRole('Administrator'));
        $user->setPassword('password');
        $this->assertTrue($user->verifyPassword('password'));
        $this->assertFalse($user->verifyPassword('wrong_password'));
        $user->setLoginAttempts(5);
        $this->assertEquals(5, $user->getLoginAttempts());
        $this->assertFalse($user->verifyPassword('wrong_password'));
        //print_r($user->getAttributes());

    }

}