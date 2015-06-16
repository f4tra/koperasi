<!-- SIDEBAR -->
<div id="sidebar" class="sidebar sidebar-fixed">
    <div class="sidebar-menu nav-collapse">
        <div class="divide-20"></div>
            <!-- SEARCH BAR -->
            <div id="search-bar">
                <input class="search" type="text" placeholder="Search" /><i class="fa fa-search search-icon"></i>
            </div>
            <!-- /SEARCH BAR -->
            <!-- SIDEBAR MENU -->
            <ul>
                <li>
                    <a href="index.html">
                        <i class="fa fa-tachometer fa-fw"></i> <span class="menu-text">Dashboard</span>
                        <span class="selected"></span>
                    </a>                    
                </li>
                <?php 
                    foreach ($menu as $key => $value) {
                        $count_menu        = $this->db->query("select count(*) as idx from tr_menu where active='0' and parent_id='".$value->id."'")->row();                        
                        if($count_menu->idx == 0){
                            echo '<li><a class="" href="#" ><i class="fa '.$value->icon.'"></i> <span class="menu-text">'.$value->label.'</span></a></li>';
                        }else{
                        

                            echo '<li class="has-sub">
                                    <a href="javascript:;" class="">
                                    <i class="fa '.$value->icon.'"></i> <span class="menu-text">'.$value->label.'</span>
                                    <span class="arrow"></span>
                                    </a>';
                            $menu_parent        = $this->db->query("select * from tr_menu where active='0' and parent_id='".$value->id."'")->result();                                                                                
                            foreach ($menu_parent as $keymp => $mp) {
                                $count_menu_parent  = $this->db->query("select count(*) as idx from tr_menu where active='0' and parent_id='".$mp->id."'")->row();                                                       
                                if($count_menu_parent->idx == 0){
                                    echo '<ul class="sub">
                                            <li><a class="" href="#"><span class="sub-menu-text">'.$mp->label.'</span></a></li>
                                          </ul>';
                                }else{
                                    echo '<ul class="sub">
                                            <li><a class="" href="#"><span class="sub-menu-text">'.$mp->label.'</span></a></li>
                                            
                                        <li class="has-sub-sub">
                                            <a href="javascript:;" class=""><span class="sub-menu-text">Third Level Menu</span>
                                            <span class="arrow"></span>
                                            </a>
                                            <ul class="sub-sub">
                                                <li><a class="" href="#"><span class="sub-sub-menu-text">Item 1</span></a></li>
                                                <li><a class="" href="#"><span class="sub-sub-menu-text">Item 2</span></a></li>
                                            </ul>
                                        </li>
                                    </ul>';
                                }
                            
                            }
                            echo '</li>';
                        }
                    }
                ?>
            </ul>
            <!-- /SIDEBAR MENU -->
    </div>
</div>
<!-- /SIDEBAR -->