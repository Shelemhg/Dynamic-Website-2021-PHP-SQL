<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/header.php'; ?>

            <section>
                <div>
                    <h1>Welcome to PHP Motors!</h1>
                </div>
                <div class="summary-box">
                    <h2>
                        DMC Delorean
                    </h2>
                    <p>3 Cup holders</p>
                    <p>Superman doors</p>
                    <p>Fuzzy dice!</p>                                    
                </div>
                <div class="delorean-wrapper">
                    <img src="/phpmotors/images/vehicles/delorean.jpg" class="delorean-img"alt="">
                </div>
                <div class="btn-wrapper">
                    <button class="own-btn">Own Today</button> 
                </div>   
            </section>         
            <section class="description">
                <div class="reviews-wrapper">
                    <h3>
                        DMC Delorean Reviews
                    </h3>
                    <ul>
                        <li>"So fast its almost like traveling in time."  (4/5)</li>
                        <li>"Cooles ride on the road."  (4/5)</li>
                        <li>"I'm feeling Marty McFly!"  (5/5</li>
                        <li>"The most futuristic ride of our day."  (5/5</li>
                        <li>"80's livin and I love it!"  (5/5)</li>
                    </ul>
                </div>
                <div class="upgrades-main-wrapper">
                    <div>
                        <h3>
                            Delorean Upgrades
                        </h3>
                    </div>
                    <div class="upgrades-wrapper">
                        <div class="upgrades">
                            <div class="img-wrapper">
                                <img src="/phpmotors/images/flux-cap.png" alt="">
                            </div>                                
                            <a href="#" >Flux Capacitor</a>
                        </div>
                        <div class="upgrades">
                            <div class="img-wrapper">       
                                <img src="/phpmotors/images/flame.jpg" alt="">
                            </div>
                            <a href="#" >Flame Decals</a>
                        </div>
                        <div class="upgrades">
                            <div class="img-wrapper">
                                <img src="/phpmotors/images/bumper_sticker.jpg" alt="">
                            </div>
                            <a href="#" >Bumper Stickers</a>
                        </div>
                        <div class="upgrades">
                            <div class="img-wrapper">
                                <img src="/phpmotors/images/hub-cap.jpg" alt="">
                            </div>
                            <a href="#" >Hub Caps</a>
                        </div>
                    </div>
                </div>
            </section>
  

            <hr>
            <div id='vehicle-wrapper' class='space'>
                <div id='vehicle-img'>
                    <img src=/phpmotors/$vehicle[invImage]>
                </div>
                <div id='info-wrapper'>
                    <div>
                        <h1>$vehicle[invMake] $vehicle[invModel]</h1>
                    </div>
                    <div>
                        <br><p class='grey padding'>$vehicle[invDescription]</p>
                        <p class='light-grey padding'><b>Color:</b> $vehicle[invColor]</p>
                        <p class='grey padding'><b>Num. in stock:</b> $vehicle[invStock]</p>
                        <p class='light-grey padding'><b>Price:</b> $vehicle[invPrice]</p>
                    </div>
                </div>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?>   