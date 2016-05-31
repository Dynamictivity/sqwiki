<?php

App::uses("Article", 'Model');
App::uses("ArticleRevision", 'Model');
App::uses("Role", 'Model');
App::uses("User", 'Model');

class AppSchema extends CakeSchema
{

    public function before($event = array())
    {
        $db = ConnectionManager::getDataSource($this->connection);
        $db->cacheSources = false;
        return true;
    }

    public function after($event = array())
    {
        if (isset($event['create'])) {
            switch ($event['create']) {
                case 'article_revisions':
                    break;
                case 'articles':
                    break;
                case 'roles':
                    break;
                case 'users':
                    $this->InsertDefaultRoles();
                    $this->InsertDefaultUsers();
                    $this->InsertDefaultArticles();
                    $this->InsertDefaultArticleRevisions();
                    break;
            }
        }
    }

    public $article_revisions = array(
        'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
        'article_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
        'user_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
        'ip_address' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
        'summary' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
        'content' => array('type' => 'text', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
        'is_active' => array('type' => 'boolean', 'null' => false, 'default' => '1'),
        'reviewed_by_user_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
        'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
        'updated' => array('type' => 'datetime', 'null' => true, 'default' => null),
        'indexes' => array(
            'PRIMARY' => array('column' => 'id', 'unique' => 1)
        ),
        'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
    );

    public $articles = array(
        'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
        'title' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
        'slug' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
        'user_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
        'ip_address' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
        'article_revision_count' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
        'comment_count' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
        'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
        'updated' => array('type' => 'datetime', 'null' => true, 'default' => null),
        'indexes' => array(
            'PRIMARY' => array('column' => 'id', 'unique' => 1)
        ),
        'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
    );

    public $comments = array(
        'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
        'user_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
        'ip_address' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
        'article_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
        'comment' => array('type' => 'text', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
        'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
        'indexes' => array(
            'PRIMARY' => array('column' => 'id', 'unique' => 1)
        ),
        'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
    );

    public $logs = array(
        'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
        'user_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
        'ip_address' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
        'model' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
        'action' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
        'record_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
        'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
        'indexes' => array(
            'PRIMARY' => array('column' => 'id', 'unique' => 1)
        ),
        'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
    );

    public $roles = array(
        'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
        'name' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
        'indexes' => array(
            'PRIMARY' => array('column' => 'id', 'unique' => 1)
        ),
        'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
    );

    public $users = array(
        'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
        'username' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
        'email' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
        'password' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
        'role_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
        'token' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 36, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
        'article_count' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
        'article_revision_count' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
        'comment_count' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
        'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
        'updated' => array('type' => 'datetime', 'null' => true, 'default' => null),
        'indexes' => array(
            'PRIMARY' => array('column' => 'id', 'unique' => 1)
        ),
        'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
    );

    public function InsertDefaultArticleRevisions()
    {
        $model = ClassRegistry::init("ArticleRevision");
        $records = array(
            array(
                "article_id" => "1",
                "user_id" => "1",
                "ip_address" => "127.0.0.1",
                "summary" => "Welcome to Sqwiki, the squeaky clean wiki!",
                "content" => "Sqwiki's goal is to be the easiest wiki software in the world to use.",
                "is_active" => "1",
                "reviewed_by_user_id" => "1"
            ), array(
                "article_id" => "2",
                "user_id" => "1",
                "ip_address" => "127.0.0.1",
                "summary" => "This is the community portal.",
                "content" => "Put resources here relevant to your wiki community.",
                "is_active" => "1",
                "reviewed_by_user_id" => "1"
            ), array(
                "article_id" => "3",
                "user_id" => "1",
                "ip_address" => "127.0.0.1",
                "summary" => "This is the support page.",
                "content" => "Put information on this page that assists your users in using your wiki.",
                "is_active" => "1",
                "reviewed_by_user_id" => "1"
            )
        );
        $model->saveMany($records, array('validate' => false, 'callbacks' => false));
//        debug('##Default article revisions inserted.');
    }

    public function InsertDefaultArticles()
    {
        $model = ClassRegistry::init("Article");
        $records = array(
            array(
                "title" => "Main",
                "slug" => "Main",
                "user_id" => "1",
                "ip_address" => "127.0.0.1"
            ), array(
                "title" => "Portal",
                "slug" => "Portal",
                "user_id" => "1",
                "ip_address" => "127.0.0.1"
            ), array(
                "title" => "Support",
                "slug" => "Support",
                "user_id" => "1",
                "ip_address" => "127.0.0.1"
            )
        );
        $model->saveMany($records, array('validate' => false, 'callbacks' => false));
//        debug('##Default articles inserted.');
    }

    public function InsertDefaultRoles()
    {
        $model = ClassRegistry::init("Role");
        $records = array(
            array(
                "name" => "Administrator"
            ),
            array(
                "name" => "Editor"
            ),
            array(
                "name" => "Member"
            ),
            array(
                "name" => "Banned"
            )
        );
        $model->saveMany($records, array('validate' => false, 'callbacks' => false));
//        debug('##Default roles inserted.');
    }

    public function InsertDefaultUsers()
    {
        $password = $this->__pwgen();

        $model = ClassRegistry::init("User");
        $records = array(
            array(
                "username" => "Anonymous",
                "email" => getenv('SQWIKI_ADMIN_EMAIL'),
                "role_id" => 4,
                "article_count" => 0,
                "article_revision_count" => 0,
                "comment_count" => 0

            ), array(
                "username" => getenv('SQWIKI_OWNER_USERNAME'),
                "password" => Security::hash($password, null, true),
                "email" => getenv('SQWIKI_OWNER_EMAIL'),
                "role_id" => 1,
                "article_count" => 0,
                "article_revision_count" => 0,
                "comment_count" => 0
            )
        );
        $model->saveMany($records, array('validate' => false, 'callbacks' => false));
//        debug('##Default users inserted.');
    }

    private function __pwgen($numwords = 2)
    {
        $adjectives = 'good,new,first,last,long,great,little,';
        $adjectives .= 'own,other,old,right,big,high,different,';
        $adjectives .= 'small,large,next,early,young,important,';
        $adjectives .= 'few,public,bad,same,able,nice,small';
        $words = 'dog,cat,sheep,sun,sky,red,ball,happy,ice,';
        $words .= 'music,movies,radio,turbo,';
        $words .= 'mouse,computer,paper,water,fire,storm,chicken,';
        $words .= 'boot,freedom,player,eyes,';
        $words .= 'path,kid,box,flower,smile,';
        $words .= 'coffee,rainbow,king,tv,ring';

        // Split by ",":
        $adjectives = explode(',', $adjectives);
        $words = explode(',', $words);
        if (count($adjectives) == 0 || count($words) == 0) {
            die('Wordlist is empty!');
        }

        // Set first word to adjective
        $r = mt_rand(0, count($adjectives) - 1);
        $pwd = ' ' . ucfirst($adjectives[$r]);

        // Add words while password is smaller than the given length
        for ($i = 1; $i < $numwords; $i++) {
            $r = mt_rand(0, count($words) - 1);
            $pwd .= ' ' . ucfirst($words[$r]);
            $pwd = ltrim($pwd, ' ');
        }

        // 1337 Speak
        $english = array('a', 'e', 'i', 'l', 'o', 's', 't', 'z');
        $leet = array('@', '3', '!', '1', '0', '5', '7', '2');
        $pwd = str_replace($english, $leet, $pwd);

        // Add exclamation point for good measure
        $pwd .= '!';

        // Output password to terminal
        print("\r\n###### ADMIN PASSWORD\r\n");
        print("'$pwd'");
        print("\r\n#####################\r\n\r\n");

        // Output password to file
        file_put_contents('/app/tmp/admin-password', $pwd);

        return $pwd;
    }
}
