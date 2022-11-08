<?php
    class Users extends Controller{

        public function __construct(){
            $this->userModel = $this->model('User');

        }

        public function getIP(){

            // Declaring a variable to hold the IP
            // address getHostName() gets the name
            // of the local machine getHostByName()
            // gets the corresponding IP
            $localIP = getHostByNamel(getHostName());
        
            // Displaying the address 
            return $localIP[1];
        }

        // Redirects to Index Page
        public function users() {
            $link   = URLROOT.$_SERVER['REQUEST_URI'];
            $pieces = explode("/", $link);
            $last   = array_pop($pieces);

            $pagination = $this->userModel->pagination();


            $data = [
                'link'          => $last,
                'pagination'    => $pagination
            ];
            $this->view('users/users', $data);
        }

        // verify user login to the system
        public function login(){
            // Check for POST
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // Process form

                // Sanitize POST data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $data = [
                    'username' => trim($_POST['username']),
                    'password' => trim($_POST['password'])
                ];


                $loggedInUser = $this->userModel->login($data['username'], $data['password']);

                if($loggedInUser){
                    // Create Session
                    $this->createUserSession($loggedInUser);
                } else {

                    echo '<script>alert("Invalid username/password, Please try again.")</script>';
                    $this->view('users/login', $data);
                }
                
            } else {
                // reset data
                $data = [
                    'username' => '',
                    'password' => ''
                ];

                // Load form
               $this->view('users/login', $data);
            }
        }

        public function createUserSession($user){
            $_SESSION['username'] = $user['username'];
            redirect('pages/dashboard');
        }

        public function logout(){
            unset($_SESSION['username']);
            session_destroy();
            redirect('users/login');
        }

        public function isLoggedIn(){
            if(isset($_SESSION['username'])){
                return true;
            } else {
                return false;
            }
        }

        // Create user account (Create Account Module)
        public function create()
        {
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                 $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $data = [
                    'fname'=> trim($_POST['first-name']),
                    'mname'=> trim($_POST['middle-name']),
                    'lname'=> trim($_POST['last-name']),
                    'ID'=> trim($_POST['Id']),
                    'app'=> trim($_POST['application']),
                    'ip' => $this->getIP(),
                    'requestor'=> trim($_POST['requestor']),
                    'remarks'=> trim($_POST['remarks'])
                ];

            
                $username = $this->generateUsername($data['fname'], $data['mname'], $data['lname'], $data['ID']);
                $password = $this->generatePassword();

                $data += [
                            'username' => $username,
                            'password' => $password
                        ];


                $createdUser = $this->userModel->createUser($username, $password);

                $this->userModel->insertToUserMaster($data);

                //insert to user_attrib??

                //insert to user_account??

                if($createdUser){
                    
                //Generate LDIF File after user is created.
                    $ldiffile = $this->generateLDIF($data['fname'],$data['lname'],$data['ID'],$username,$password);

                //Shows the viewer of file contents.
                $this->view('users/ldif', $data = [ 'ldif' => $ldiffile]);

                }

            } else {
                $data = [
                    'fname'=> '',
                    'mname'=> '',
                    'lname'=> '',
                    'ID'=> '',
                    'app'=> '',
                    'requestor'=> '',
                    'remarks'=> ''
                ];
               $this->view('users/create', $data);
            }
        }

        // gets list of users
        public function show()
        {
            $search=[':search' => ''];

            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $search = [':search' => trim($_POST['search'])];
            }

            $result = $this->userModel->getUserList($search);
            $data = $result;
            $this->view('users/show', $data);
        }

        public function generateUsername($fname, $mname, $lname, $ID)  
        {
            $username = substr($fname,0,1).($mname==null? "" :substr($mname,0,1)).preg_replace('/\s+/','',$lname).$ID;
            return strtoupper($username);
        }

        public function generatePassword()
        {
            $password = substr(str_shuffle("abcdefghijklmnopqrstuvwxyz"), 0, 3) . rand(10000, 99999);
            return $password;
        }

        // Generate LDIF file function
        public function generateLDIF($fname, $lname, $ID, $username, $password ){
            $givenName = strtoupper($fname);
            $surName = strtoupper($lname);
            $cn= $username;
            $uid= $username;
            $mail= $username."@kccmalls.com";
            $employeeNum = $ID;
            $LDIF = "dn: cn=$username,cn=Users,dc=kccmalls,dc=com\nobjectclass: top\nobjectclass: organizationalperson\nobjectclass: person\nobjectclass: inetorgperson\nobjectclass: KCCOBJ\nobjectclass: rsimUser\ngivenname: $givenName\nsn: $surName\ncn: $cn\nuid: $uid\nemployeenumber: $employeeNum\nmail: $mail\ndescription: Department Store\ndisplayname: $cn\npreferredlanguage: en\nuserstore: rsimStoreId=2,cn=rsimStores,cn=RSIM,dc=kccmalls,dc=com\nuserstore: rsimStoreId=1,cn=rsimStores,cn=RSIM,dc=kccmalls,dc=com\nuserstore: rsimStoreId=3,cn=rsimStores,cn=RSIM,dc=kccmalls,dc=com\nuserstore: rsimStoreId=4,cn=rsimStores,cn=RSIM,dc=kccmalls,dc=com\nuserstore: rsimStoreId=5,cn=rsimStores,cn=RSIM,dc=kccmalls,dc=com\nuserstore: rsimStoreId=6,cn=rsimStores,cn=RSIM,dc=kccmalls,dc=com\nuserstore: rsimStoreId=7,cn=rsimStores,cn=RSIM,dc=kccmalls,dc=com\nuserstore: rsimStoreId=8,cn=rsimStores,cn=RSIM,dc=kccmalls,dc=com\nuserstore: rsimStoreId=9,cn=rsimStores,cn=RSIM,dc=kccmalls,dc=com\nuserstore: rsimStoreId=41,cn=rsimStores,cn=RSIM,dc=kccmalls,dc=com\nuserstore: rsimStoreId=42,cn=rsimStores,cn=RSIM,dc=kccmalls,dc=com\nuserstore: rsimStoreId=43,cn=rsimStores,cn=RSIM,dc=kccmalls,dc=com\nuserstore: rsimStoreId=45,cn=rsimStores,cn=RSIM,dc=kccmalls,dc=com\nuserstore: rsimStoreId=46,cn=rsimStores,cn=RSIM,dc=kccmalls,dc=com\nuserstore: rsimStoreId=44,cn=rsimStores,cn=RSIM,dc=kccmalls,dc=com\nuserstore: rsimStoreId=47,cn=rsimStores,cn=RSIM,dc=kccmalls,dc=com\nuserstore: rsimStoreId=48,cn=rsimStores,cn=RSIM,dc=kccmalls,dc=com\nuserstore: rsimStoreId=49,cn=rsimStores,cn=RSIM,dc=kccmalls,dc=com\nemploymentstatus: 0\nssn: 123456789\npreferredcountry: US\nuserrole: rsimRoleName=KCC Admin,cn=rsimRoles,cn=RSIM,dc=kccmalls,dc=com\nhomestore: rsimStoreId=2,cn=rsimStores,cn=RSIM,dc=kccmalls,dc=com\nuserpassword: $password";

            $file = fopen("$username.ldif", "w") or die("Unable to open file!");
            fwrite($file, $LDIF);
            fclose($file);
            return $username.'.ldif';
            exit();
            
        }

        public function download_ldif()
        {   
            if($_SERVER['REQUEST_METHOD'] == 'POST'){

                // Sanitize POST data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $file = [
                    'ldif' => trim($_POST['ldiffile'])
                ];

                if (file_exists($file['ldif'])) {
                    header('Content-Description: File Transfer');
                    header('Content-Type: application/octet-stream');
                    header('Content-Disposition: attachment; filename='.basename($file['ldif']));
                    header('Content-Transfer-Encoding: binary');
                    header('Expires: 0');
                    header('Cache-Control: must-revalidate');
                    header('Pragma: public');
                    header('Content-Length: ' . filesize($file['ldif']));
                    ob_clean();
                    flush();
                    readfile($file['ldif']);
                    exit();
                    $this->view('users/create', $data=[]);
                }  

            }
        }
    }
