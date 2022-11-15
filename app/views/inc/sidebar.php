<?php 
    $url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
?>


<aside class="relative bg-gradient-to-br from-blue-500 to-indigo-900 h-screen w-64 hidden sm:block shadow-xl overflow-y-auto scrollbar-hide transition ease-in-out delay-150">
    <div>
        <div class="p-6">
            <a href="<?php echo URLROOT;?>/homepage/dashboard" class="text-white text-3xl font-semibold hover:text-gray-300"><?php echo SITENAME?></a>
        </div>
        <nav class="text-white text-base font-semibold py-2 overflow-y-auto scrollbar-hide maxh">
            <div id="accordion-open" data-accordion="open">
                <ul>
                    <!--DASHBOARD-->
                    
                        <li class="flex flex-row">
                                <a href="<?php echo URLROOT;?>/homepage/dashboard" class="flex items-center py-4 pl-6 nav-item text-white w-10/12 <?php if (strpos($url, 'dashboard')) {echo 'active-nav-link';} else {echo ' opacity-75';}?>" 
                                >
                                    <i class="fas fa-chart-line mr-3"></i>
                                    Dashboard 
                                </a>

                                    <button type="button" class="flex-auto items-center py-4 hover:bg-gray-300 text-white" 
                                    
                                    aria-expanded="<?php 
                                    if (strpos($url, 'diskstorage')) {echo 'true';} else {echo ' false';}?>" 
                                    aria-controls="dashboard" 
                                    data-accordion-target="#dashboard"
                                    data-collapse-toggle="dashboard"> 
                                    <!--Code above is needed for collapse open while select-->
                                    <!--Change here for control variables-->
                                            <svg sidebar-toggle-item class="w-6 h-8" fill="currentColor" viewBox="0 -5 12 28" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                            </svg>  
                                        
                                    </button>
                                
                                    
                            
                        </li>
                        <!--DASHBOARD DROP DOWN CONTENTS-->
                        <ul id="dashboard" class="hidden py-1" data-accordion="open">
                        <li>
                            <a href="<?php echo URLROOT;?>/diskstorages/diskstorage/null" class="flex items-center py-4 pl-6 nav-item text-white <?php if (strpos($url, 'diskstorage')) {echo 'active-nav-link';} else {echo ' opacity-75';}?>" 
                                    >
                                <i class="fas fa-compact-disc mr-3"></i>
                                Disk Storage
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo URLROOT;?>/homepage/flashrecovery" class="flex items-center py-4 pl-6 nav-item text-white <?php if (strpos($url, 'flashrecovery')) {echo 'active-nav-link';} else {echo ' opacity-75';}?>" 
                                    >
                                <i class="fas fa-compact-disc mr-3"></i>
                                Flash Recovery
                            </a>
                        </li>
                        </ul>
                    <!--DATABASES-->
                    <li class="flex flex-row">
                                <a href="<?php echo URLROOT;?>/homepage/#" class="flex items-center py-4 pl-6 nav-item text-white w-10/12 <?php if (strpos($url, '#')) {echo 'active-nav-link';} else {echo ' opacity-75';}?>" 
                                >
                                    <i class="fas fa-warehouse mr-3"></i>
                                    Databases 
                                </a>

                                    <button type="button" class="flex-auto items-center py-4 hover:bg-gray-300 text-white" 
                                    
                                    aria-expanded="<?php 
                                    if (strpos($url, '#')) {echo 'true';} else {echo ' false';}?>" 
                                    aria-controls="databases" 
                                    data-accordion-target="#databases"
                                    data-collapse-toggle="databases"> 
                                    <!--Code above is needed for collapse open while select-->
                                    <!--Change here for control variables-->
                                            <svg sidebar-toggle-item class="w-6 h-8" fill="currentColor" viewBox="0 -5 12 28" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                            </svg>  
                                        
                                    </button>
                                
                                    
                            
                        </li>
                    <ul id="databases" class="hidden py-1  ">
                            <li>
                            <a href="<?php echo URLROOT;?>/homepage/dashboard"  class="flex items-center hover:opacity-100 py-4 pl-12 nav-item text-white <?php if (strpos($url, 'oracle')){ echo 'active-nav-link ';}else{echo 'opacity-75';}?>">
                                <i class="fas fa-database mr-3"></i>
                            ORACLE
                            </a>
                            </li>
                            <li>
                                <a href="<?php echo URLROOT;?>/homepage/dashboard"  class="flex items-center hover:opacity-100 py-4 pl-12 nav-item text-white <?php if (strpos($url, 'mssql')){ echo 'active-nav-link ';}else{echo 'opacity-75';}?>">
                                    <i class="fas fa-database mr-3"></i>
                                MSSQL
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo URLROOT;?>/homepage/dashboard"  class="flex items-center hover:opacity-100 py-4 pl-12 nav-item text-white <?php if (strpos($url, 'mariadb')){ echo 'active-nav-link ';}else{echo 'opacity-75';}?>">
                                    <i class="fas fa-database mr-3"></i>
                                    MARIA DB
                                </a>
                            </li>  
                        </ul>


                    <li>
                        <a href="<?php echo URLROOT;?>/users/show"  class="flex items-center hover:opacity-100 py-4 pl-6 nav-item text-white <?php if (strpos($url, 'show')){ echo 'active-nav-link ';}else{echo 'opacity-75';}?>">
                        <i class="fas fa-user-cog mr-3"></i>
                        Manage Users
                        </a>
                    </li>
                    
                </ul>
            </div>
            
            <script src="https://unpkg.com/flowbite@1.3.4/dist/flowbite.js"></script>
        </nav>
    </div>

    <!--Time & Date-->
    <div class="left-0 widgets transition ease-in-out delay-150 bg-gradient-to-br from-blue-500 to-indigo-900 rounded-lg">
        <div class="w-9/10 justify-center px-1 mt-1">
            <div id="swtClock" class="bg-gradient-to-r from-pink-100 to-blue-100 rounded-t-lg" style="text-align: center;"></div>
            <script type="text/javascript" src="https://www.superwebtricks.com/wp-content/uploads/clock.js.txt"></script>
            
        </div>
        <!--Calendar-->
        <div class="w-full px-1">
            <iframe src="https://calendar.google.com/calendar/embed?height=600&wkst=1&bgcolor=%23039BE5&ctz=Asia%2FManila&showTitle=0&showTz=0&showCalendars=0&showPrint=0&showTabs=0&src=YmI1ZDVkMjgxZThjNTQ5MWYyZGRkOTBlMGQ5YzZkYWU4NWI2ODcxNzc5OGI5ZjE0NTI5ZDFiZGQzZWZmNGUxMUBncm91cC5jYWxlbmRhci5nb29nbGUuY29t&color=%23795548" style="border-width:0; border-radius: 0 0 5px 5px;pointer-events:none;" class="shadow-lg" width="100%" height="100%" frameborder="0" scrolling="no"></iframe>
        </div>
    </div>
    
    
</aside>
    <div class="w-full flex flex-col h-screen overflow-y-auto scrollbar-hide">
        <!-- Desktop Header -->
        <header class="w-full items-center bg-gray-600 py-2 px-6 hidden sm:flex ">
            <!--TOP NAVBAR-->
            <div class="w-3/4">
                <div>
                    <!--MONITOR-->
                    <button id="dropdownDefault" data-dropdown-toggle="dropdown-monitor" class="text-white bg-gray-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800
                    <!--THIS BELOW CHANGE URL-->
                    <?php echo strpos($url, 'dashboard')? 'block focus:bg-blue-800': 'hidden';?>
                    " type="button">MONITOR<svg class="ml-2 w-4 h-4" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg></button>
                    <!-- Dropdown menu -->
                    <div id="dropdown-monitor" class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700">
                        <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefault">
                        <li>
                            <a href="#" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">User Sessions</a>
                        </li>
                        <li>
                            <a href="#" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Locked Sessions</a>
                        </li>
                        <li>
                            <a href="#" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">RMAN Backup Reports</a>
                        </li>
                        <li>
                            <a href="#" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Redo Log File Switches</a>
                        </li>
                        <li>
                            <a href="#" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Redo Generation Per Day</a>
                        </li>
                        <li>
                            <a href="#" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Top SQL Running Processes</a>
                        </li>
                        </ul>
                    </div>

                    <!--PERFORMANCE-->
                    <button id="dropdownDefault" data-dropdown-toggle="dropdown-performance" class="text-white bg-gray-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800
                    <?php echo strpos($url, 'dashboard')? 'block focus:bg-blue-800':'hidden';?>
                    " type="button">PERFORMANCE<svg class="ml-2 w-4 h-4" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg></button>
                    <!-- Dropdown menu -->
                    <div id="dropdown-performance" class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700">
                        <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefault">
                        <li>
                            <a href="#" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">PGA Target Advisor</a>
                        </li>
                        <li>
                            <a href="#" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">SGA Target Advisor</a>
                        </li>
                        <li>
                            <a href="#" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Buffer Cache Advisor</a>
                        </li>
                        <li>
                            <a href="#" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Hit Ratio - Quick Checks</a>
                        </li>
                        <li>
                            <a href="#" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Table Statistics Status</a>
                        </li>
                        </ul>
                    </div>

                    <!--SECURITY-->
                    <button id="dropdownDefault" data-dropdown-toggle="dropdown-security" class="text-white bg-gray-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800
                    <?php echo strpos($url, 'dashboard')? 'block focus:bg-blue-800':'hidden';?>
                    " type="button">SECURITY<svg class="ml-2 w-4 h-4" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg></button>
                    <!-- Dropdown menu -->
                    <div id="dropdown-security" class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700">
                        <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefault">
                        <li>
                            <a href="#" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">List All DB Users</a>
                        </li>
                        <li>
                            <a href="#" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">DB Role Priviledge</a>
                        </li>
                        <li>
                            <a href="#" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Create LDIF Files For SSO</a>
                        </li>
                        <li>
                            <a href="#" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Oracle Retail User Management</a>
                        </li>
                        </ul>
                    </div>

                    <!---->
                    <button id="dropdownDefault" data-dropdown-toggle="dropdown-storage" class="text-white bg-gray-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800
                    <?php echo strpos($url, 'dashboard')? 'block focus:bg-blue-800':'hidden';?>
                    " type="button">STORAGE & OBJECTS<svg class="ml-2 w-4 h-4" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg></button>
                    <!-- Dropdown menu -->
                    <div id="dropdown-storage" class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700">
                        <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefault">
                        <li>
                            <a href="#" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Database File Layout</a>
                        </li>
                        <li>
                            <a href="#" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Invalid Objects</a>
                        </li>
                        <li>
                            <a href="#" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Table Space Usage</a>
                        </li>
                        <li>
                            <a href="#" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Table Monitoring</a>
                        </li>
                        <li>
                            <a href="#" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Table Indexes</a>
                        </li>
                        </ul>
                    </div>

                    <!--Database Disk-->
                    <button id="dropdownDefault" data-dropdown-toggle="dropdown-disk" class="text-white bg-gray-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800
                    <?php echo strpos($url, 'diskstorage')? 'block focus:bg-blue-800':'hidden';?>
                    " type="button">Database<svg class="ml-2 w-4 h-4" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg></button>
                    <!-- Dropdown menu -->
                    <div id="dropdown-disk" class="whitespace-normal hidden z-10 w-fit bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700">

                            <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefault">
                                <li>
                                <a href="<?php echo URLROOT;?>/diskstorages/diskstorage/RMSPRD">
                                        <button type="button" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                            192.168.32.184 - RMSPRD
                                        </button>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo URLROOT;?>/diskstorages/diskstorage/RDWPRD">
                                        <button type="submit" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                            192.168.32.198 - RDWPRD
                                        </button>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo URLROOT;?>/diskstorages/diskstorage/RMSOID">
                                        <button type="submit" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                            192.168.32.162 - RMS/OID
                                        </button>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo URLROOT;?>/diskstorages/diskstorage/SIMREIM">
                                        <button type="submit" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                        192.168.32.164 - SIM/REIM
                                        </button>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo URLROOT;?>/diskstorages/diskstorage/RPM">
                                        <button type="submit" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                        192.168.32.165 - RPM
                                        </button>
                                    </a>
                                </li>
                            </ul>
                    </div>
                </div>
            </div>
            <!--TOP NAVBAR-->
            <div x-data="{ isOpen: false }" class="relative w-1/2 flex justify-end">
            <?php if(isset($_SESSION['username'])): ?>
                <h4 class="py-1 px-2 text-white"><?php echo  '<b>'.$_SESSION['username'].'</b>' ?></h4>
            <?php endif; ?>
                <button @click="isOpen = !isOpen" class="realtive z-10 w-12 h-12 rounded-full overflow-hidden border-4 border-gray-400 hover:border-gray-300 focus:border-gray-300 focus:outline-none">
                    <img src="<?php echo URLROOT; ?>/public/img/user.png">
                </button>
                <button x-show="isOpen" @click="isOpen = false" class="h-full w-full fixed inset-0 cursor-default"></button>
                <div x-show="isOpen" class="absolute w-32 justify-center bg-gray-600 rounded-lg shadow-lg py-2 mt-16">
                    <a href="<?php echo URLROOT; ?>/users/logout" class="block text-white  text-center px-4 py-2  hover:bg-gray-600">Sign Out</a>
                </div>
            </div>
        </header>
            <main class="flex-grow p-6 bg-gray-800">