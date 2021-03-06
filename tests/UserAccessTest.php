<?php

use \PHPUnit\Framework\TestCase;

use \PragmaPHP\UserAccess\UserAccess;
use \PragmaPHP\UserAccess\Entry\User;
use \PragmaPHP\UserAccess\Entry\Group;
use \PragmaPHP\UserAccess\Entry\Role;
use \PragmaPHP\UserAccess\Provider\FileUserProvider;
use \PragmaPHP\UserAccess\Provider\FileGroupProvider;
use \PragmaPHP\UserAccess\Provider\FileRoleProvider;
use \PragmaPHP\UserAccess\Util\AuditLog;

class UserAccessTest extends TestCase {

    public function test() {
        $userProvider = new FileUserProvider('testdata/users');
        $userProvider->deleteUsers();
        $groupProvider = new FileGroupProvider('testdata/groups');
        $groupProvider->deleteGroups();
        $roleProvider = new FileRoleProvider('testdata/roles');
        $roleProvider->deleteRoles();
        $userAccess = new UserAccess($userProvider, $groupProvider, $roleProvider);
        $this->assertNotEmpty($userAccess->getUserProvider());
        $this->assertNotEmpty($userAccess->getGroupProvider());
        $this->assertNotEmpty($userAccess->getRoleProvider());

        $user = new User('userid1');
        $user->setPassword('password');
        $user = $userAccess->getUserProvider()->createUser($user);
        $this->assertTrue($userAccess->getUserProvider()->isUniqueNameExisting('userid1'));
        $users = $userAccess->getUserProvider()->getUsers();
        $this->assertNotEmpty($users);
        $this->assertEquals(1, count($users));
        $user = $userAccess->getUserProvider()->getUser($user->getId());
        $this->assertNotEmpty($user);
        $this->assertEquals('userid1', $user->getUniqueName());
        $this->assertFalse($user->isReadOnly());

        $find = $userAccess->getUserProvider()->findUsers('uniqueName', '*ser*');
        $this->assertNotEmpty($find);
        $this->assertEquals(1, count($find));

        $group = new Group('groupid1');
        $group = $userAccess->getGroupProvider()->createGroup($group);
        $this->assertTrue($userAccess->getGroupProvider()->isUniqueNameExisting('groupid1'));
        $groups = $userAccess->getGroupProvider()->getGroups();
        $this->assertNotEmpty($groups);
        $this->assertEquals(1, count($groups));
        $group = $userAccess->getGroupProvider()->getGroup($group->getId());
        $this->assertNotEmpty($group);
        $this->assertEquals('groupid1', $group->getUniqueName());
        $this->assertFalse($group->isReadOnly());

        $find = $userAccess->getGroupProvider()->findGroups('uniqueName', '*roup*');
        $this->assertNotEmpty($find);
        $this->assertEquals(1, count($find));

        $role = new Role('roleid1');
        $role = $userAccess->getRoleProvider()->createRole($role);
        $this->assertTrue($userAccess->getRoleProvider()->isUniqueNameExisting('roleid1'));
        $roles = $userAccess->getRoleProvider()->getRoles();
        $this->assertNotEmpty($roles);
        $this->assertEquals(1, count($roles));
        $role = $userAccess->getRoleProvider()->getRole($role->getId());
        $this->assertNotEmpty($role);
        $this->assertEquals('roleid1', $role->getUniqueName());
        $this->assertFalse($role->isReadOnly());

        $find = $userAccess->getRoleProvider()->findRoles('uniqueName', '*ole*');
        $this->assertNotEmpty($find);
        $this->assertEquals(1, count($find));

        $userAccess->getUserProvider()->deleteUsers();
        $userAccess->getGroupProvider()->deleteGroups();
        $userAccess->getRoleProvider()->deleteRoles();

    }

}