<?php

/**
 * @return  where business categories exists, it returns table rows of 3 columns
 *             COL1: serial number
 *             COL2 : Category Name
 *             COL3: action
 * where action contains buttons for editing and deleting.
 *
 * else: a table row with 1 column containing "<i> No Categories</i>"
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
        $i++;
    }
//
    if (count($branchArray) > 0) {
        return implode("", $branchArray);
    } else {
        return "  <tr>
            <td> <i> No Categories</i></td>
           
        </tr>";
    }

}

/**
 * @return  where business categories exists, it returns table rows of 4 columns
 *             COL1: serial number
 *             COL2 : Category Name
 *             COL3: Count
 *             COL4: action
 * where action contains buttons for viewing.
 *
 * else: a table row with 1 column containing "<i> No Categories</i>"
 */
function getCategoriesReportWithAction()
{
    $catObj = new \App\Models\BussinessCategory();
    $cCat = $catObj::get();
    $branchArray = [];
    $i = 1;
    foreach ($cCat as $cb) {
         $viewLink = "<a  href='javascript:;' onclick='view_category($cb->id)'   class='  btn btn-info btn-xs'>  View </a>";
        $branchArray[] = "
        <tr>
            <td>" .
            $i
            . "</td>
            
            <td>" .
            $cb->name
            . "</td>
             <td>" .
            $cb->count_listing($cb->id)
            . "</td>
            <td>"
            .
            $viewLink
            . "</td>
        </tr>
        ";
        $i++;
    }
//
    if (count($branchArray) > 0) {
        return implode("", $branchArray);
    } else {
        return "  <tr>
            <td> <i> No Categories</i></td>
           
        </tr>";
    }

}

/**
 * @return  where business categories exists, it returns table rows of 3 columns
 *             COL1: serial number
 *             COL2 : Category Name
 *             COL3: action
 * where action contains button for a "Modify" link.
 *
 * else: a table row with 1 column containing "<i> No Categories</i>"
 */
function getCategoriesWithActiontoModifyProperties()
{
    $catObj = new \App\Models\BussinessCategory();
    $cCat = $catObj::get();
    $branchArray = [];
    $i = 1;
    foreach ($cCat as $cb) {
        $modLink = "<a  href='javascript:;' onclick='modifyCat($cb->id)'   class='  btn btn-info btn-xs'>  Modify </a>";
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
            $modLink
            . "</td>
        </tr>
        ";
        $i++;
    }
//
    if (count($branchArray) > 0) {
        return implode("", $branchArray);
    } else {
        return "  <tr>
            <td> <i> No Categories</i></td>
           
        </tr>";
    }

}

/**
 * @return  where business categories exists, it returns input buttons for categories with type='checkbox'
 *
 * else: a table row with 1 column containing "<i> No Categories</i>"
 */
function getCategoriesforBiz()
{
    $catObj = new \App\Models\BussinessCategory();
    $cCat = $catObj::get();
    $catArray = [];
    $initial_usage_id = 0;
    foreach ($cCat as $i => $cb) {
        $initial_usage_id = $cb->id;
        $catArray[] = "
                           <label>
                                <input style='margin-left: 10px;'  type='radio' name='cat_id' value='" . $cb->id . "'  onclick='makeCategoryCall(\"$initial_usage_id\");' checked /> &nbsp; &nbsp; " . $cb->name
            . "</label>
                        ";
    }

//
    if (count($catArray) > 0) {
        $t = count($catArray) - 1;
//        $catArray[] = "
//                         <input class='hidden' id='last_id_index' value='" . $initial_usage_id . "' />" ;
        return implode("", $catArray);
    } else {
        return "  <tr>
            <td> <i> No Categories</i></td>
        </tr>";
    }

}

/**
 * @parse   $listing_id 
 * @return  where business categories exists, it returns input buttons for categories with type='checkbox'
 *
 * else: a table row with 1 column containing "<i> No Categories</i>"
 *
 *Note: this function is the same as  getCategoriesforBiz() but the listing_id is for the function makeCategoryCall() that is
 *  triggered by the onclick event on the input tag.
 */
function getCategoriesforBizEdit($listing_id)
{
    $catObj = new \App\Models\BussinessCategory();
    $cCat = $catObj::get();
    $catArray = [];
    $initial_usage_id = 0;
    foreach ($cCat as $i => $cb) {
        $initial_usage_id = $cb->id;
        $catArray[] = "
                           <label>
                                <input style='margin-left: 10px;'  type='radio' name='cat_id' value='" . $cb->id . "'  onclick='makeCategoryCall(\"$initial_usage_id\",\"$listing_id\");' checked /> &nbsp; &nbsp; " . $cb->name
            . "</label>
                        ";
    }

//
    if (count($catArray) > 0) {
        $t = count($catArray) - 1;
//        $catArray[] = "
//                         <input class='hidden' id='last_id_index' value='" . $initial_usage_id . "' />" ;
        return implode("", $catArray);
    } else {
        return "  <tr>
            <td> <i> No Categories</i></td>
        </tr>";
    }

}

/**
 * @param $id
 * @return  where business categories exists, it returns a string
 *          string : name of the category of the ID passed
 *
 * else: null
 */
function getCategoryNamefromID($id)
{
    if ((trim($id) == null) || ($id <= 0)) {
        return null;

    }
    $catObj = \App\Models\BussinessCategory::where('id', $id)->first();

    if (count($catObj) > 0) {
        return $catObj->name;

    } else {
        return null;
    }
}

/**
 * @return  where Attribute exists, it returns table rows of 3 columns
 *             COL1: serial number
 *             COL2 : Attribute Name
 *             COL3: action
 * where action contains buttons for editing and deleting.
 *
 * else: a table row with 1 column containing "<i> No Attribute</i>"
 */
function getCategoryPropertyWithAction($id)
{
    if ((trim($id) == null) || ($id <= 0)) {
        return "  <tr> <td> <i> No Categories</i></td>  </tr>";

    }
    $catObj = new \App\Models\Attribute();
    $cCat = $catObj::where('bussiness_category_id', $id)->get();
    $branchArray = [];
    $i = 1;
    foreach ($cCat as $cb) {
        $editLink = "<a  href='javascript:;' onclick='editProperty($cb)'    class='  btn btn-info btn-xs'>Edit   </a>";
        $delLink = "<a  href='javascript:;' onclick='deleteProperty($cb->id)'   class='  btn btn-danger btn-xs'>  Delete </a>";
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
        $i++;
    }
//
    if (count($branchArray) > 0) {
        return implode("", $branchArray);
    } else {
        return "  <tr>
            <td> <i> No Attribute</i></td>
           
        </tr>";
    }
}


/**
 * @return   input elements for a category
 *
 * else: a table row with 1 column containing "<i> No Attribute</i>"
 */
function getFormInputsForCategory($id)
{
    if ((trim($id) == null) || ($id <= 0)) {
        return "  <tr> <td> <i> No Categories</i></td>  </tr>";
    }
    $catObj = new \App\Models\Attribute();
    $cCat = $catObj::where('bussiness_category_id', $id)->get();
    $branchArray = [];
    $i = 1;
    foreach ($cCat as $cb) {
        $form_name = str_replace(' ', '_', $cb->name);
        $branchArray[] = '
        <div class="form-group"><label class="control-label">' . $cb->name . ' </label><input
                                        class="form-control" required name="' . $form_name . '@@' . $cb->id . '" placeholder=""
                                        type="text"></div>
        ';
        $i++;
    }
//
    if (count($branchArray) > 0) {
        return implode("", $branchArray);
    } else {
        return "  <tr>
            <td> <i> No Attribute</i></td>
           
        </tr>";
    }
}

/**
 * @return   edit input elements for a category
 *
 * else: a table row with 1 column containing "<i> No Attribute</i>"
 */
function getFormInputsEditsForCategory($listing_id,$id)
{
    if ((trim($id) == null) || ($id <= 0)) {
        return "  <tr> <td> <i> No Categories</i></td>  </tr>";
    }
    $catObj = new \App\Models\ListingAttribute();
    $cCat = $catObj::where(['listing_id'  => $listing_id, 'category_id'=> $id])->get();
    $branchArray = [];
    $i = 1;

    // if this listing doesn't have any attribute information, create an avenue to add attribute information
    if ($cCat->count() == 0) {
        # code...
        return getFormInputsForCategory($id);
    }
    
    foreach ($cCat as $cb) {
        $form_name = str_replace(' ', '_', $cb->attribute->name);
        $branchArray[] = '
        <div class="form-group"><label class="control-label">' . $cb->attribute->name . ' </label><input
                                        class="form-control" required name="' . $form_name . '@@' . $cb->attribute->id . '" placeholder=""
                                       value="' . $cb->value . ' " type="text"></div>
        ';
        $i++;
    }
//
    if (count($branchArray) > 0) {
        return implode("", $branchArray);
    } else {
        return "  <tr>
            <td> <i> No Attribute</i></td>
           
        </tr>";
    }
}

/**
 * @return   elements for a category
 *
 * else: a table row with 1 column containing "<i> No property</i>"
 */
function getDisplayPropertiesForListing($id)
{
    if ((trim($id) == null) || ($id <= 0)) {
        return "  <tr> <td> <i> No Categories</i></td>  </tr>";
    }
    $catObj = new \App\Models\ListingAttribute();
    $cCat = $catObj::where('listing_id', $id)->get();
    $branchArray = [];
    $i = 1;
    foreach ($cCat as $cb) {
        $branchArray[] = '
        <div class="form-group"><label class="control-label">' . $cb->attribute->name . ' </label>
                                <span class="form-control disabled" >' . $cb->value . ' </span></div>

        
        ';
        $i++;
    }
//
    if (count($branchArray) > 0) {
        return implode("", $branchArray);
    } else {
        return "  <tr>
            <td> <i> No Attribute</i></td>
           
        </tr>";
    }
}