<?php
/**
 * Created by PhpStorm.
 * User: Onwuasoanya George
 * Date: 7/15/2016
 * Time: 2:31 AM
 */
function getCategoriesWithAction()
{
    $catObj = new \App\Models\BussinessCategory();
    $cCat = $catObj::get();
    $branchArray = [];
    $i = 1;
    foreach ($cCat as $cb) {
        $editLink = "<a  href='javascript:;' onclick='editCat($cb)'    class='  btn btn-info btn-xs'>Edit   </a>";
        $delLink = "<a  href='javascript:;' onclick='deleteCat($cb->id)'   class='  btn btn-danger btn-xs'>  Delete </a>";
        $branchArray[] = "
        <tr>
            <td>" .
            $i 
            . "</td>
            
            <td>" .
            $cb->name
            . "</td>
            <td>"
            .
            $editLink . $delLink
            . "</td>
        </tr>
        ";
        $i ++;
    }
//
    if(count($branchArray) > 0){
        return implode("", $branchArray);
    }else{
        return "  <tr>
            <td> <i> No Categories</i></td>
           
        </tr>";
    }

}
function getCategoriesforBiz()
{
    $catObj = new \App\Models\BussinessCategory();
    $cCat = $catObj::get();
    $catArray = [];
     foreach ($cCat as $i => $cb) {
         if($i == 0){
             $catArray[] = "<input checked type='checkbox' name='cat_id[]' value=".$cb->id." />&nbsp;&nbsp; ".$cb->name." <br />";
         }else{
             $catArray[] = "<input   type='checkbox' name='cat_id[]' value=".$cb->id." />&nbsp;&nbsp; ".$cb->name." <br />";
         }

     }
//
    if(count($catArray) > 0){
        return implode("", $catArray);
    }else{
        return "  <tr>
            <td> <i> No Categories</i></td>
           
        </tr>";
    }

}
