<?php 
    if($this->uri->segment(1) != null)
        $fixet =  "sidebar-fixed";
    else
        $fixet =  "";

        ?>
<!-- SIDEBAR -->
<div id="sidebar" class="sidebar <?php echo $fixet;?> ">
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
                    <a href="<?php echo site_url();?>">
                        <i class="fa fa-tachometer fa-fw"></i> <span class="menu-text">Dashboard</span>
                        <span class="selected"></span>
                    </a>                    
                </li>
                <?php 
                    foreach ($menu as $key => $value) {                        
                        $count_menu        = $this->db->query("select count(*) as idx from tr_menu where active='0' and parent_id='".$value->id."'")->row();                        
                        if (!$this->acl->is_allowed($value->link)) continue;
                        if($count_menu->idx == 0){
                            echo '<li><a class="" href="'.site_url($value->link).'" ><i class="fa '.$value->icon.'"></i> <span class="menu-text">'.$value->label.'</span></a></li>';
                        }else{
                        

                            echo '<li class="has-sub">
                                    <a href="javascript:;" class="">
                                    <i class="fa '.$value->icon.'"></i> <span class="menu-text">'.$value->label.'</span>
                                    <span class="arrow"></span>
                                    </a>';
                            $menu_parent        = $this->db->query("select m.id,m.parent_id,m.label,m.icon,r.name as link from tr_menu m left join acl_resources r on r.id=m.resource_id where m.active='0' and m.parent_id='".$value->id."'")->result();                                                                                
                            echo '<ul class="sub">';
                            foreach ($menu_parent as $keymp => $mp) {
                                if (!$this->acl->is_allowed($mp->link)) continue;
                                $count_menu_parent  = $this->db->query("select count(*) as idx from tr_menu where active='0' and parent_id='".$mp->id."'")->row();                                                                                       
                                if($count_menu_parent->idx == 0){
                                    echo '<li><a class="" href="'.site_url($mp->link).'"><span class="sub-menu-text">'.$mp->label.'</span></a></li>';
                                }else{
                                    echo '
                                        <li class="has-sub-sub">
                                            <a href="javascript:;" class=""><span class="sub-menu-text">'.$mp->label.'</span>
                                            <span class="arrow"></span>
                                            </a>
                                            <ul class="sub-sub">';
                                                $menu_child        = $this->db->query("select m.id,m.parent_id,m.label,m.icon,r.name as link from tr_menu m left join acl_resources r on r.id=m.resource_id where m.active='0' and m.parent_id='".$mp->id."'")->result();                                                                                
                                                foreach ($menu_child as $keychld => $child) {
                                                    if (!$this->acl->is_allowed($child->link)) continue;
                                                echo '<li><a class="" href="'.site_url($child->link).'"><span class="sub-sub-menu-text">'.$child->label.'</span></a></li>';
                                                
                                                }

                                            echo '</ul>
                                        </li>
                                    ';
                                }
                            
                            }
                            echo '</ul></li>';
                        }
                    }
                ?>
            </ul>
            <!-- /SIDEBAR MENU -->
    </div>
</div>
<!-- /SIDEBAR -->