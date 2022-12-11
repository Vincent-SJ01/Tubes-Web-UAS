<template>
    <div>
        <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
            <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">Ngurir </a>
            
            <button
                class="navbar-toggler position-absolute d-md-none collapsed"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#sidebarMenu"
                aria-controls="sidebarMenu"
                aria-expanded="false"
                aria-label="Toggle navigation">
                
                <span class="navbar-toggler-icon"></span>
            
            </button>
        
        </header>
        
        
        <div class="container-fluid pt-2 mt-3">
            <div class="row">
                <nav
                    id="sidebarMenu"
                    class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse mt-4">
                    
                    <div class="position-sticky pt-2">
                        <ul class="nav flex-column">
        
                            <li class="nav-item">
                                <router-link :to="{name:'Admin.Home'}" class="nav-link">testinng</router-link>
                            </li>
                            <li class="nav-item">
                                <router-link :to="{name:'Admin.Paket'}" class="nav-link">Drop Point</router-link>
                            </li>
                            <li class="nav-item"></li>
                        </ul>
                    </div>
                
                </nav>
                
                <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4"> 
				    <!-- View Route -->
				    <router-view></router-view>
			
			    </main>
            </div>
        </div>
    </div>
</template>

<script>
export default {
  name: "DashboardAdmin",
};
</script>

<style>
body {
  font-size: 0.875rem;
}

.feather {
  width: 16px;
  height: 16px;
  vertical-align: text-bottom;
}
/*
* Sidebar
*/
.sidebar {
  position: fixed;
  top: 0;
  bottom: 0;
  left: 0;
  z-index: 100;

  padding: 48px 0 0;
  box-shadow: inset -1px 0 0 rgba(0, 0, 0, 0.1);
}

.sidebar-sticky {
  position: relative;
  top: 0;
  height: calc(100vh - 48px);
  padding-top: 0.5rem;
  overflow-x: hidden;
  overflow-y: auto;
}

.sidebar .nav-link {
  font-weight: 500;
  color: #333;
}

.sidebar .nav-link .feather {
  margin-right: 4px;
  color: #727272;
}

.sidebar .nav-link.active {
  color: #2470dc;
}

.sidebar .nav-link:hover .feather,
.sidebar .nav-link.active .feather {
  color: inherit;
}

.sidebar-heading {
  font-size: 0.75rem;
  text-transform: uppercase;
}

/*
* Navbar
*/

.navbar-brand {
  padding-top: 0.75rem;
  padding-bottom: 0.75rem;
  font-size: 1rem;
  background-color: rgba(0, 0, 0, 0.25);
  box-shadow: inset -1px 0 0 rgba(0, 0, 0, 0.25);
}

.navbar .navbar-toggler {
  top: 0.25rem;
  right: 1rem;
}

.navbar .form-control {
  padding: 0.75rem 1rem;
  border-width: 0;
  border-radius: 0;
}

.form-control-dark {
  color: #fff;
  background-color: rgba(255, 255, 255, 0.1);
  border-color: rgba(255, 255, 255, 0.1);
}

.form-control-dark:focus {
  border-color: transparent;
  box-shadow: 0 0 0 3px rgba(255, 255, 255, 0.25);
}
</style>
