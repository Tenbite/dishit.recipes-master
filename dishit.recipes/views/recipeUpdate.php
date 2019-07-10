
<?php include('views/header.php'); ?>
<?php include('views/menubar.php'); ?>

<script type="text/javascript" src="javascript/toTitleCase.js"></script>
<script type="text/javascript" src="javascript/formatPhone.js"></script>




    <div id="main" class="uk-panel uk-panel-box uk-margin-left uk-margin-right" >
        <h1><center>Update Your Recipe</center></h1>
        <?php if($details<>"") extract($details); ?>

        <form class='formStyle' id='frmDetails' method='post' action='.'>
<!--            <input type='hidden' name='action'-->
<!--                   value='--><?php //echo ($action=='recipeUpdate' or $action=='recipeSaveUpdate')?'recipeUpdate':'recipeSaveUpdate'; ?><!--'>-->
            <input type='hidden' name='user_id' value='<?php echo(isset($user_id))?$user_id:"" ?>'>

            <?php $title = (isset($title))?$title:"" ?>
            <div class="uk-margin-top uk-float-left">
                <label class="uk-form-label" for='txtTitle'>Title:</label>
            </div>

            <div class="uk-form-row">
                <input class="uk-width-1-1 uk-form-large"  type='text' name='title' id='txtTitle'
                       value="<?php echo getRecipeTitle($_REQUEST['id']); ?>">
            </div>

            <img src="images/Error.gif" id="errTitle"
                 width="14" height="14" alt="Error icon"
                 style="visibility: <?php echo (isset($errors['title']))? "visible;": "hidden;"; ?>"
                 title=" <?php echo (isset($errors['title'])) ? $errors['title']:""; ?>"
            >
            <br>

            <div class="uk-margin-top uk-float-left">
                <label class="uk-form-label"  for='txtDescription'>Description:</label>
            </div>

            <div class="uk-form-row">
                <textarea class="uk-textarea uk-width-1-1" name="description" id="txtDescription" rows="5" cols="50"><?php echo getRecipeDescription($_REQUEST['id']); ?></textarea>
            </div>

            <img src="images/Error.gif" id="errDescription"
                 width="14" height="14" alt="Error icon"
                 style="visibility: <?php echo (isset($errors['description']))? "visible;": "hidden;"; ?>"
                 title=" <?php echo (isset($errors['description'])) ? $errors['description']:""; ?>"
            >
            <br>

            <div class="uk-margin-top uk-float-left">
                <label for='txtIngredients'>Ingredients:</label>
            </div>

            <div class="uk-form-row">
                <textarea class="uk-textarea uk-width-1-1" name="ingredients" id="txtIngredients" rows="5" cols="50"><?php echo getRecipeIngredients($_REQUEST['id']); ?></textarea>
            </div>
            <img src="images/Error.gif" id="errIngredients"
                 width="14" height="14" alt="Error icon"
                 style="visibility: <?php echo (isset($errors['ingredients']))? "visible;": "hidden;"; ?>"
                 title=" <?php echo (isset($errors['ingredients'])) ? $errors['ingredients']:""; ?>"
            >
            <br>

            <div class="uk-form-row">
                <label for='txtDirections'>Directions:</label>
            </div>

            <textarea class="uk-textarea uk-width-1-1" name="directions" id="txtDirections" rows="5" cols="50"><?php echo getRecipeDirections($_REQUEST['id']); ?></textarea>
            <img src="images/Error.gif" id="errDirections"
                 width="14" height="14" alt="Error icon"
                 style="visibility: <?php echo (isset($errors['directions']))? "visible;": "hidden;"; ?>"
                 title=" <?php echo (isset($errors['directions'])) ? $errors['directions']:""; ?>"
            >
            <br>



            <div class="uk-form-row">
                <button class="uk-width-1-1 uk-button uk-button-primary uk-button-large uk-icon-save" type='submit' id='btnUpdate' name='btnUpdate'> Save</button>
            </div>

            <div class="uk-form-row">
                <button class="uk-width-1-1 uk-button uk-button-danger uk-button-large uk-icon-save" type='submit' id='btnCancel' name='btnCancel'> Cancel</button>
            </div>

            <div class="uk-form-row">
                <button class="uk-width-1-1 uk-button uk-button-secondary uk-button-large uk-icon-undo" type='reset' id='btnReset'> Reset</button>
            </div>
        </form>
    </div>



<?php include('views/footer.php'); ?>