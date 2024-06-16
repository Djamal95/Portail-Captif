<?php

namespace Epaphrodites\database\requests\typeRequest\sqlRequest\insert;

use Epaphrodites\database\requests\typeRequest\noSqlRequest\insert\insert as InsertInsert;
use Epaphrodites\epaphrodites\define\config\traits\currentSubmit;

class insert extends InsertInsert
{

    use currentSubmit;
    /**
     * Add users to the system from the console
     *
     * @param string|null $login
     * @param string|null $password
     * @param int|null $UserGroup
     * @return bool
     */
    public function sqlConsoleAddUsers(
        ?string $login = null,
        ?string $password = null,
        ?int $UserGroup = null
    ): bool {

        $UserGroup = $UserGroup !== NULL ? $UserGroup : 1;

        if (!empty($login) && count(static::initQuery()['getid']->sqlGetUsersDatas($login)) < 1) {

            $this->table('usersaccount')
                ->insert(' login , password , usersgroup ')
                ->values(' ? , ? , ? ')
                ->param([static::initNamespace()['env']->no_space($login), static::initConfig()['guard']->CryptPassword($password), $UserGroup])
                ->IQuery();

            return true;
        } else {
            return false;
        }
    }

    /**
     * Add users to the system
     *
     * @param string|null $login
     * @param int|null $usersgroup
     * @return bool
     */
    public function sqlAddUsers(
        ?string $login = null,
        ?int $usersgroup = null
    ): bool {

        if (!empty($login) && !empty($usersgroup) && count(static::initQuery()['getid']->sqlGetUsersDatas($login)) < 1) {

            $this->table('usersaccount')
                ->insert(' login , password , usersgroup ')
                ->values(' ? , ? , ? ')
                ->param([static::initNamespace()['env']->no_space($login), static::initConfig()['guard']->CryptPassword($login), $usersgroup])
                ->IQuery();

            $actions = "Add a User : " . $login;
            static::initQuery()['setting']->ActionsRecente($actions);

            return true;
        } else {
            return false;
        }
    }

    /**
     * Request to insert datas
     * @param string $email
     * @param string $namesurname
     * @param string $phone
     * @param string $password
     * @return bool|string
     */
    public function registerUser(string $email, string $namesurname, string $phone, string $password)
    {
        if (!empty($email) && !empty($namesurname) && !empty($phone) && !empty($password)) {
            if (static::verifyUser($email, $phone)) {
                return static::initNamespace()['msg']->answers('log');
            } else {
                $this->table('users')
                    ->insert('email, namesurname, phone, password')
                    ->values('?, ?, ?, ?')
                    ->param([$email, $namesurname, $phone, $password])
                    ->IQuery();
                return true;
            }
        } else {
            return false;
        }
    }
}
