<?php
    if(isset($korisnik)){  
    $nId =$korisnik->id_user;
    $activePoll = isThereActivePoll($nId);
}
?>
    <!-- Footer Start -->
    <div id="footer" class="container-fluid bg-dark text-light py-2 " data-wow-delay="0.3s">
        <div class="container pt-2 text-center">
            <div class="row g-5 pt-4 d-flex justify-content-between">
                <div class="col-lg-3 col-md-6">
                    <h3 class="text-white mb-4">Quick Links</h3>
                    <div class="d-flex flex-column justify-content-start">
                        <a class="text-light mb-2" href="index.php"><i class="bi bi-arrow-right text-primary me-2"></i>Home</a>
                        <a class="text-light mb-2" href="author.php"><i class="bi bi-arrow-right text-primary me-2"></i>About Author</a>
                        <?php 
                            if(isset($korisnik)){
                                if($korisnik->role_name == "user"){ 
                                echo '<a class="text-light mb-2" href="contact.php"><i class="bi bi-arrow-right text-primary me-2"></i>Contact Admin</a>';
                                if($activePoll){
                                    echo '<a class="text-light mb-2" href="poll.php"><i class="bi bi-arrow-right text-primary me-2"></i>Complete The Poll</a>';
                                }
                                }
                            }
                        ?>
                        <a class="text-light mb-2" href="documentation.pdf" target="_blank"><i class="bi bi-arrow-right text-primary me-2"></i>Documentation</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h3 class="text-white mb-4">Get In Touch</h3>
                    <p class="mb-2"><i class="bi bi-geo-alt text-primary me-2"></i>123 Street, New York, USA</p>
                    <p class="mb-2"><i class="bi bi-envelope-open text-primary me-2"></i>belleparfums@gmail.com</p>
                    <p class="mb-0"><i class="bi bi-telephone text-primary me-2"></i>+381 011 123 456</p>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h3 class="text-white mb-4">Follow Us</h3>
                    <div class="d-flex  justify-content-center">
                        <a class="btn btn-lg btn-primary btn-lg-square rounded me-2" href="#"><i class="fab fa-twitter fw-normal"></i></a>
                        <a class="btn btn-lg btn-primary btn-lg-square rounded me-2" href="#"><i class="fab fa-facebook-f fw-normal"></i></a>
                        <a class="btn btn-lg btn-primary btn-lg-square rounded me-2" href="https://www.linkedin.com/in/aleksa-pantic-9039b5225/" target="_blank"><i class="fab fa-linkedin-in fw-normal"></i></a>
                        <a class="btn btn-lg btn-primary btn-lg-square rounded" href="#"><i class="fab fa-instagram fw-normal"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid text-light py-3" style="background: #051225;">
        <div class="container">
            <div class="row  d-flex justify-content-center">
                <div class="col-md-12 text-center text-md-center">
                    <p id="copyrighttext" class="mb-md-0">&copy; Aleksa Pantic 102/19</p>
                </div>
            </div>
            
        </div>
    </div>

    <!-- Footer End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./lib/wow/wow.min.js"></script>
    <script src="./lib/easing/easing.min.js"></script>
    <script src="./lib/waypoints/waypoints.min.js"></script>
    <script src="./lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="./lib/tempusdominus/js/moment.min.js"></script>
    <script src="./lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="./lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>
    <script src="./lib/twentytwenty/jquery.event.move.js"></script>
    <script src="./lib/twentytwenty/jquery.twentytwenty.js"></script>
    <!-- Template Javascript -->
    <script src="./assets/js/main.js"></script>
</body>

</html>