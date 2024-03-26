<?php 
    $links = [
        "Home" => "home",
		"Ranking" => "ranking",
        "Operating Systems" => "operating-system"
    ];
    
    $buttons = [
        "Login" => "login",
        "Join the community" => "register"
    ];
?>
    <nav class="navbar navbar-expand-lg bg-body-tertiary nav-container">
        <div class="container-fluid justify-content-center">
        	<a href='home' class="navbar-brand">Phone Recommendations</a>
        	<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
        	<div class="collapse navbar-collapse" id="navbarSupportedContent">
        		<ul class="navbar-nav me-auto mb-2 mb-lg-0">
                	<?php foreach ($links as $key => $value) {   
                	    echo "<li class='nav-item'><a class='nav-link active' aria-current='page' href='$value'>$key</a></li>";
                	}; ?>
                	
            	</ul>
            	<div class="d-flex">
            		<?php foreach ($buttons as $key => $value) { 
            			    $class = '';
            			    
            			    if($key == "Login") {
            			        $class = "btn-outline me-2";
            			    } else {
            			        $class = "btn-primary";
            			    }
            			    
                    	    echo "<a href='$value'><button type='button' class='$class btn'>
                                $key
                            </button></a>";
                        }; ?>
            	</div>
        	</div>
        </div>
    </nav>
