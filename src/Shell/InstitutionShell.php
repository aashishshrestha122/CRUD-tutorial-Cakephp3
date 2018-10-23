<?php
namespace App\Shell;

use Cake\Console\Shell;

class InstitutionShell extends Shell
{
    public function initialize(){
        parent::initialize();
        $this->loadModel('Institution');
        $this->loadModel('Courses');
    }

//     public function add(){
//     	$string = file_get_contents("http://HPGEZFEQCUA96W34905U@data.unistats.ac.uk/api/v4/KIS/Institutions.Json?pageIndex=1&pageSize=50");
// 		$json = json_decode($string);
//         $count=0;
//         $total=0;
//         $notInserted=[];
//     	foreach($json as $value){
//             $this->out(serialize($value));
//     		// $this->out("Name: ".$value->nm."\t");
//     		// $this->out("City: ".$value->cty."\t");
//     		// $this->out("House: ".$value->hse."\t");
//     		// $this->out("Years: ".$value->yrs."\n");	

//     //         $monarch = $this->Monarchs->newEntity();
//     //         $monarch->name = $value->nm;
//     //         $monarch->city = $value->cty;
//     //         $monarch->house = $value->hse;
//     //         $monarch->year = $value->yrs;
//     //         if($this->Monarchs->save($monarch)){
//     //             $count++;
//     //         }else{
//     //             $notInserted[]=serialize($value);
//     //         }
//     //         $total++;
//     // 	}

//     //     $this->out("Total row: ".$total." Inserted row: ".$count." Not Inserted: ".count($notInserted));
//     //     if(count($notInserted)>0){
//     //         file_put_contents('log', $notInserted);
//     //     }
//     // }
// }
// }

public function data(){
    $page=1;
    
        $string = file_get_contents("http://HPGEZFEQCUA96W34905U@data.unistats.ac.uk/api/v4/KIS/Institutions.Json?pageSize=2000");
        $string=trim($string);
        
        $json = json_decode($string);
         $count=0;
        $total=0;
        $notInserted=[];
        foreach($json as $value){
        	$institution = $this->Institution->newEntity();
            $institution->APROutcome = $value->APROutcome;
            $institution->ApiUrl = $value->ApiUrl;
            $institution->Country = $value->Country;
            $institution->Name = $value->Name;
            $institution->NumberOfCourses = $value->NumberOfCourses;
            $institution->PUBUKPRN = $value->PUBUKPRN;
            $institution->PUBUKPRNCountry = $value->PUBUKPRNCountry;
            $institution->QAAReportUrl = $value->QAAReportUrl;
            $institution->SortableName = $value->SortableName;
            $institution->StudentUnionUrl = $value->StudentUnionUrl;
            $institution->StudentUnionUrlWales = $value->StudentUnionUrlWales;
            $institution->TEFOutcome = $value->TEFOutcome;
            $institution->UKPRN = $value->UKPRN;

            if($this->Institution->save($institution)){
                $count++;
            }else{
                $notInserted[]=serialize($value);
            }
            $total++;
        }
            $this->out("Total row: ".$total." Inserted row: ".$count." Not Inserted: ".count($notInserted));
            if(count($notInserted)>0){
                file_put_contents('log', $notInserted);
            }
	 
}
        

    public function Coursedata($id){
        $page=1;
        // while(True){
        // http://data.unistats.ac.uk/api/v4/KIS/Institution/{PUBUKPRN}/Courses.{FORMAT}?pageIndex={PAGEINDEX}&pageSize={PAGESIZE} 
            $string1 = file_get_contents("http://HPGEZFEQCUA96W34905U@data.unistats.ac.uk/api/v4/KIS/Institution/$id/Courses.Json?pageSize=10000");
            $string1=trim($string1);
            // if($string1=="[]"){
            // break;
            // }
                $aa = json_decode($string1);
                $c=0;
                $t=0;
                $nI=[];
                foreach($aa as $val){
                    $courses = $this->Courses->newEntity();
                    $courses->ApiUrl = $val->ApiUrl;
                    $courses->KisCourseId = $val->KisCourseId;
                    $courses->KisMode = $val->KisMode;
                    $courses->Title = $val->Title;
                    $courses->TitleInWelsh = $val->TitleInWelsh;
                    $courses->PUBUKPRN = $id;

                    if($this->Courses->save($courses)){
                    $c++;
                    }else{
                    $nI[]=serialize($val);
                    }
                    $t++;
                }
            $this->out("for $id row: ".$t." Inserted row: ".$c." Not Inserted: ".count($nI));
            if(count($nI)>0){
            file_put_contents('log', $nI);
            }
        // $page++;
        // }
    }







  public function CourseAll()
   {
      $institutions=$this->Institution->find();
      foreach($institutions as $institution)
      {
        $id=$institution->PUBUKPRN;
        if (!empty($id))
            $this->Coursedata($id);

      }
   }


}
?>