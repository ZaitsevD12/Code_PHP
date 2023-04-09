 <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link" style="font-weight:bold; font-size:22px;">
    

      <span class="brand-text font-weight-center">Cистема покупки <br/> билетов</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      
      <!-- Sidebar Menu -->
      <nav class="mt-2">

        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Фильмы
                <i class="fas fa-angle-left right"></i>
                
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="add-films.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Создать</p>
                </a>
              </li>
             
			  <li class="nav-item">
                <a href="manage-films.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Управление</p>
                </a>
              </li>
			  </ul>
          </li>
		  
		  <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-address-card"></i>
              <p>
                Сеансы
                <i class="fas fa-angle-left right"></i>
                
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="add-seance.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Создать</p>
                </a>
              </li>
			  <li class="nav-item">
                <a href="manage-seance.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Управление</p>
                </a>
              </li>
             </ul>
          </li>
				 	 
		  <li class="nav-item">
            <a href="../logout.php" class="nav-link">
              <i class="nav-icon fas fa-window-close"></i>
              <p>
                 Выход
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
		  </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>