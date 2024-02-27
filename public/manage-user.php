
<?php
session_start();
$_SESSION['patron-view'] = false;

require_once('dbConn.php');
require_once('form-validation.php');
require_once('./partials/head.php');
require_once('message-display.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    // POST FROM ADD FORM
    if(isset($_POST['first-name'])){


        $fist_name = trim($_POST['first-name']);
        $last_name = trim($_POST['last-name']);
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        $confirm_password = trim($_POST['c-password']);
        $role = $_POST['role'];

        $hash_password = hash("sha256",$password);
        $user_to_validate = [$fist_name, $last_name, $email, $password,$confirm_password];
        $user = ["", $fist_name, $last_name, $email, $hash_password, $role];

        // validate form
        if(emptyFields($user_to_validate)){
            showErrorMessage("Empty fields not allowed. Please try again.");
        }
        else if(!validEmail($email)){
            showErrorMessage("Invalid email. Please try again.");
        }
        else if(!validPassword($password)){
            showErrorMessage("Invalid password. Please try again.");
        }
        else if(!checkForDuplicates([$password, $confirm_password])){
                showErrorMessage("Passwords do not match");
        }

        else{

            $user_sql = "INSERT INTO `{$database}`.`{$user_table}` VALUES (?,?,?,?,?,?)";
            if(mysqli_execute_query($conn,$user_sql,$user)){
                showSuccessMessage('User added successfully.');
            }else{
                showErrorMessage('Error creating user. Please try again or contact technical support.');
            }
        }

    }

    // POST FROM UPDATE FORM
    else if(isset($_POST['edit-fname'])){
        $user = [
            trim($_POST['edit-fname']),
            trim($_POST['last-name']),
            trim($_POST['email']),
            trim($_POST['role']),
            trim($_POST['user-id'])
        ];

        // validate form
        if(emptyFields($user)){
            showErrorMessage("Empty fields not allowed. Please try again.");
        }
        else if(!validEmail(trim($_POST['email']))){
            showErrorMessage("Invalid email. Please try again or contact technical support.");
        }
        else{
            $sql = "UPDATE `{$database}`.`{$user_table}` SET `first_name` = ?, `last_name` = ?, `email` = ?, `role` = ? WHERE `user_id` = ?";
            if(mysqli_execute_query($conn, $sql, $user)){
                if($_POST['user-id'] == $_SESSION['auth-user']['user_id']){
                    $_SESSION['auth-user']['first_name']=trim($_POST['edit-fname']);
                    $_SESSION['auth-user']['last_name']=trim($_POST['last-name']);
                    $_SESSION['auth-user']['email']=trim($_POST['email']);
                    $_SESSION['auth-user']['role']=trim($_POST['role']);
                }
                showSuccessMessage("User updated successfully.");
            }
            else{
                showErrorMessage("Error updating user. Please try again.");
            }
        }
    }


    // EDIT AND DELETE BUTTON CLICK
    else if(isset($_POST['edit-id'])){
        require_once('./partials/head.php');
        switch($_POST['edit-option']){

            case 'edit':
                $_SESSION['user-edit'] = true;
                $_SESSION['screen'] = 'user';

                $_SESSION['first-name'] = trim($_POST['edit-first-name']);
                $_SESSION['last-name'] = trim($_POST['edit-last-name']);
                $_SESSION['user-id'] = trim($_POST['edit-id']);
                $_SESSION['role'] = trim($_POST['edit-role']);
                $_SESSION['email'] = trim($_POST['edit-email']);

                // $_SESSION['edit-id'] == $_SESSION['auth-user']['user_id'] && $_SESSION['edit-id'] == $_SESSION['auth-user']['user_id'] ?

                redirect('index.php');
                break;
            // handle delete
            case 'delete':
                handleDeleteUser();
                break;
        }
        require_once('./partials/footer.php');
    }

    // CANCEL BUTTON CLICK
    elseif(isset($_POST['cancel-delete'])){
        redirect("index.php");
    }

    // EXECUTE DELETE
    elseif(isset($_POST['delete-id'])){
        $delete_sql = "DELETE FROM `{$database}`.`{$user_table}` WHERE `user_id` = {$_POST['delete-id']}";
        if(mysqli_query($conn,$delete_sql)){
            showSuccessMessage("User deleted successfully.");
        }
        else{
            showErrorMessage("Error deleting user. Please try again or contact technical support.");
        }


    }
}






function handleDeleteUser(){
    echo '
        <div class="absolute top-0 left-0 h-screen w-screen bg-app-modal">
            <form action="manage-user.php" method="post" id="cancel">
                <input type="text" name="cancel-delete" value="0" hidden>
            </form>
            <form action="manage-user.php" method="post" id="delete-form" class=" bg-app-tertiary text-gray-200 absolute top-1/2 -translate-y-1/2 left-1/2 -translate-x-1/2 pb-4  px-6 w-[340px] text-sm">
                <p class="bg-app-blue text-app-orange text-lg font-light -mx-6 px-6 py-1">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 inline mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                    </svg>
                WARNING
                </p>
                <input name="delete-id" type="text" value="'.$_POST['edit-id'].'" hidden>
                <input name="start" type="text" value="'.$_POST['del-first-name'].'" hidden>
                <input name="end" type="text" value="'.$_POST['del-last-name'].'" hidden>
                <p class="my-8"> Are you sure you want to remove all records of <span class="italic text-app-orange">'.ucfirst($_POST['del-first-name']).' '.ucfirst($_POST['del-last-name']).'</span> ? This action is irreversible. </p>
                <div class="flex justify-around items-center">
                    <button form="delete-form" class="text-white bg-red-600 py-1 px-8 rounded-md">YES</button>
                    <button form="cancel" class="text-white bg-green-600  py-1 px-8 rounded-md">NO</button>
                </div>
            </form>
        </div>
        ';

}

?>