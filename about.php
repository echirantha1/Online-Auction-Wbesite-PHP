 <!-- Masthead-->
        <header>
            <div class="container h-20">
                <div class="row h-20 align-items-center justify-content-center text-center">
                    <div class="col-lg-5 align-self-end mb-4" style="background: #0000002e;">
                    	 <h1 class="text-white font-weight-bold">About Us</h1>
                        <hr class="divider my-1" />
                    </div>
                    
                </div>
            </div>
        </header>

    <section class="page-section">
        <div class="container">
    <?php echo html_entity_decode($_SESSION['system']['about_content']) ?>        
            
        </div>
        </section>