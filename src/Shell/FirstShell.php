<?php

namespace App\Shell;

use Cake\Console\Shell;

class FirstShell extends Shell
{
    public function main()
    {
        $this->out('Hello world.');
    }
 public function initialize(){
        parent::initialize();
        $this->loadModel('Articles');
        $this->loadModel('Users');
    }

    public function show()
    {
        $user_id = 7;
        // $count = 0;
        $article = $this->Articles->find()->where(['Articles.user_id' => $user_id]);
        $total = $article->count();
        $this->out(print_r($total, true));
        // $this->out(print_r($article, true));
    }

    public function add()
    {
    	$article = $this->Articles->newEntity();
    	$article['id'] = '10';
    	$article['tile'] = 'abcdefghi';
    	$article['body'] = 'aisfhnaslfhqwoihrflasfaufhaf';
    	$article['user_id'] = '26';
    	$article['category_id'] = '3';

    	if($this->Articles->save($article)){
                $this->out('Sucess');
            }else{
                $this->out('fail');
            }
    }

}
?>