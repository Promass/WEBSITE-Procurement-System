<!-- Page Name: modal-classes.php -->
<!-- Description: This page contains a class that handles all error messages and displays them to the user -->

<?php

class Modal {
    
    private $msg;

    public function __construct($msg) {
        $this->msg = $msg;
    }

    private function displayModal($head, $body) {
        echo
        '
        <button type="button" id="modalButton" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal" hidden>
          Open modal
        </button>

        <div class="modal" id="myModal">
          <div class="modal-dialog">
            <div class="modal-content" style="background: #303030; border-radius: 10px;">

              <div class="modal-header" style="border-color: #202020;">
                <h4 class="modal-title">'.$head.'</h4>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
              </div>

              <div class="modal-body" style="border-color: #202020;">
                '.$body.'
              </div>

              <div class="modal-footer" style="border-color: #202020; display: flex; align-items: center; justify-content: center;">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal" style="border-radius: 10px;">Close</button>
              </div>
        
            </div>
          </div>
        </div>

        <script>
            window.onload = function(){
                document.getElementById("modalButton").click();
            }
        </script>
        ';
    }

    public function handleMessage() {
        if (!empty($this->msg)) {
            switch ($this->msg) {
                case 'unauthorised':
                    $this->displayModal("Access Unauthoriesed!", "Please log in to continue.");
                    break;
                case 'itemdemanded':
                    $this->displayModal("Item Demand Sent!", "Your demand has been sent and is being processed.");
                    break;
                case 'demandrejected':
                    $this->displayModal("Demand Rejected!", "The demand was successfully rejected. All quotations received has been rejected.");
                    break;
                case 'itemcreated':
                    $this->displayModal("Item Created!", "The new item has been added to the inventory.");
                    break;
                case 'signedout':
                    $this->displayModal("Signed Out!", "Your session has been successfully terminated.");
                    break;
                case 'offersent':
                    $this->displayModal("Offer Sent!", "Your offer has been sent. It is awaiting approval from the system admin.");
                    break;
                case 'offeraccepted':
                    $this->displayModal("Offer Accepted!", "Offer was accepted. The relevant suppliers were notified.");
                    break;
                case 'invalidtype':
                    $this->displayModal("Invalid Type!", "Please select a valid account type.");
                    break;
                case 'usercreated':
                    $this->displayModal("User Created!", "The user was created and added to the database. They will be able to login and access the system.");
                    break;
                case 'stmtfailed':
                    $this->displayModal("Database Access Error!", "Something went wrong in the server.");
                    break;
                case 'accountdeleted':
                    $this->displayModal("Account Deleted!", "User account was made inactive. Their access has been restricted. The account still exists in the database.");
                    break;
                case 'itemdeleted':
                    $this->displayModal("Item Deleted!", "Item was made unavailable. It is no longer available for demands. The item still exists in the database.");
                    break;
                case 'couldnotdemand':
                    $this->displayModal("Could Not Demand!", "Something went wrong.");
                    break;
                case 'couldnotrejectdemand':
                    $this->displayModal("Could Not Reject Demand!", "Something went wrong.");
                    break;
                case 'couldnotacceptoffer':
                    $this->displayModal("Could Not Accept Offer!", "Something went wrong.");
                    break;
                case 'emptyinput':
                    $this->displayModal("Empty Input!", "Please fill in the required fields.");
                    break;
                case 'itemalreadyexist':
                    $this->displayModal("Item Already Exists!", "It is already available in the inventory or was previously available.");
                    break;
                case 'usernotfound':
                    $this->displayModal("User Not Found!", "A user with the provided username does not exist.");
                    break;
                case 'wrongpassword':
                    $this->displayModal("Wrong Password!", "Please try again using the correct password.");
                    break;
                case 'couldnotoffer':
                    $this->displayModal("Could Not Offer!", "Something went wrong.");
                    break;
                case 'useralreadyexist':
                    $this->displayModal("User already Exist!", "The username provided has already an active or inactive account in the system.");
                    break;
                case 'sessiontimedout':
                    $this->displayModal("Session Timed Out!", "Please log in to the system again");
                    break;
                default:
                    exit(0);
            }
        }
    }

}

?>