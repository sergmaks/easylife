<!-- Carousel -->
             <div id="carousel" class="carousel slide" data-interval="6000" data-ride="carousel" data-pause="none">
                 <!-- Indicators  -->
                 <ol class="carousel-indicators">
                     <li data-target="#carousel" data-slide-to="0" class="active"></li>  
                     <li data-target="#carousel" data-slide-to="1"></li>
                     <li data-target="#carousel" data-slide-to="2"></li>
                 </ol>
                 <!-- Slides -->
                 <div class="carousel-inner">
      <!-- 1st Slide -->   
	            <div class="active item">
                        <div class="back" <?php echo 'style="background-image: url(\'' . $this->baseurl . '/templates/' . $this->template . '/images/x-large/1.jpg\')"'?>>
                           
                            <div class="overlay">
                                <div class="slide-caption">
                                  <span class="fa-stack icon">
		                                <i class="fa fa-circle-o fa-stack-2x"></i>
		                                <i class="fa fa-question fa-stack-1x"></i>
		                            </span>
                                    <span class="fa fa-circle-o"></span> Что приготовить?<br>
                                    <span class="fa fa-circle-o"></span> Где это все купить?<br>
                                    <span class="fa fa-check"></span> Доверьте это нам!
                                </div>
                            </div>
                        </div>
                    </div>
	   <!-- 2nd Slide --> 
                     <div class="item">
                         <div class="back" <?php echo 'style="background-image: url(\'' . $this->baseurl . '/templates/' . $this->template . '/images/x-large/2.jpg\')"'?>>
                             <div class="overlay">
                                 <div class="slide-caption">
                                    <span class="fa-stack icon">
		                                <i class="fa fa-circle-o fa-stack-2x"></i>
		                                <i class="fa fa-phone fa-stack-1x"></i>
		                            </span>
                                     <span style="font-size: 77%">Сделайте заказ и каждый день Вы будете наслаждаться уникальным блюдом, получая удовольствие от процесса приготовления!</span>
                                </div>
                             </div>
                         </div>
                     </div>
	   <!-- 3rd Slide --> 
                     <div class="item">
                         <div class="back" <?php echo 'style="background-image: url(\'' . $this->baseurl . '/templates/' . $this->template . '/images/x-large/3.jpg\')"'?>>
                             <div class="overlay">
                                 <div class="slide-caption">
		                            <span class="fa-stack icon">
		                                <i class="fa fa-circle-o fa-stack-2x"></i>
		                                <i class="fa fa-thumbs-o-up fa-stack-1x"></i>
		                               </span>
                                    Готовить с нами быстро, просто и вкусно!<br>
                                    Easy Life - оставь время для себя!
                                </div>
                             </div>
                         </div>
                     </div>
                 </div>
<!-- Carousel Navigation -->
                 <a href="#carousel" class="carousel-control left" data-slide="prev">
                     <span class="glyphicon glyphicon-chevron-left"></span>
                 </a>
                 <a href="#carousel" class="carousel-control right" data-slide="next">
                     <span class="glyphicon glyphicon-chevron-right"></span>
                 </a>
