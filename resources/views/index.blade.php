  @extends ('welcome')
  @section ('title', 'vle | Home')
  <!-- Start menu -->
  @include ('pages.menu')
  <!-- End menu -->

  @section('content')
<div class="container-fluid">   
          <img  src="assets/img/slider/1.jpg" alt="img" width="100%" height="60%" >
 </div>         
  <div class="container">
  <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
            <div id="imaginary_container"> 
             
            </div>
        </div>
  </div>
</div>
<BR />
<BR />
    
    <!-- Start single slider item -->
   
  <!-- Start service  -->
  <section id="mu-service">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-md-12">
          <div class="mu-service-area">
            <!-- Start single service -->
            <div class="mu-service-single">
              <span class="fa fa-book"></span>
              <h3>Courses</h3>
            </div>
            <!-- Start single service -->
            <!-- Start single service -->
            <div class="mu-service-single">
              <span class="fa fa-users"></span>
              <h3>Expert Teachers</h3>
            </div>
            <!-- Start single service -->
            <!-- Start single service -->
            <div class="mu-service-single">
              <span class="fa fa-table"></span>
              <h3>Online Courses</h3>
            </div>
            <!-- Start single service -->
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End service  -->

  <!-- Start about us -->
  <section id="mu-about-us">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="mu-about-us-area">           
            <div class="row">
              <div class="col-lg-6 col-md-6">
                <div class="mu-about-us-left">
                  <!-- Start Title -->
                  <div class="mu-title">
                    <h2> Continuing Education </h2>              
                  </div>
                  <!-- End Title -->
                  <p>The continuous rise in enrolment in CE programmes in Class XI and XII warrants the need to look into the provision of lifelong learning opportunities more seriously. Therefore, tertiary education providers in Bhutan should adapt to this changing need in our society to allow people to 
upgrade their knowledge and qualification.
 Inside a classroom, students listen attentively to the teacher. The only difference from a conventional classroom is that the teacher in not physically present but appears on a standard computer screen talking in a heavy Indian accent.

Called the Computer Aided Learning (CAL), this is now already a reality in Bhutan and the education ministry believes that it is the future of education in the country.

The facility was formally launched at Jakar Higher Secondary School in Bumthang last month and 168 schools in the country already have the facility. About 700 teachers from around the country have already been trained to enable students to use the new method.

 This is a program under the Chiphen Rigpel Project to enable students to learn online. It aims to provide children with new learning methods using technology. The same technology can also be used for rehabilitative programs and is not limited only to schools.

Under this program, students can also use the facility to complement classroom teaching by looking for supplementary knowledge on any subject. This has been implemented in the following colleges under Royal University of Bhutan:</p>
                  <ul>
                    <li>College of Science and Technology</li>
                    <li>College of Natural Resources</li>
                    <li>Gaeddu College of Business Studies</li>
                    <li>College of Language and Culture Studies</li>
                    <li>Jigme Namgyel Engineering College</li>
                    <li>Samtse College of Education</li>
                    <li>Institute of Language and Culture Studies</li>
                    <li>Royal Thimphu Bhutan</li>
                    <li>Sherubtse College</li>
                  </ul>
                  <p>Life long learning for anyone, in any course from anywhere and at anytime</p>
                </div>
              </div>
              <div class="col-lg-6 col-md-6">
                <div class="mu-about-us-right">  

                <a id="mu-abtus-video" src="https://www.youtube.com/watch?v=rZ6ilE5Ca3c" target="mutube-video">
                  <img src="assets/img/about-us.jpg" alt="img">
                </a>                
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End about us -->

  <!-- Start about us counter -->
  <section id="mu-abtus-counter">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="mu-abtus-counter-area">
            <div class="row">
              <!-- Start counter item -->
              <div class="col-lg-3 col-md-3 col-sm-3">
                <div class="mu-abtus-counter-single">
                  <span class="fa fa-book"></span>
                  <h4 class="counter">{{count($course)}}</h4>
                  <p>Subjects</p>
                </div>
              </div>
              <!-- End counter item -->
              <!-- Start counter item -->
              <div class="col-lg-3 col-md-3 col-sm-3">
                <div class="mu-abtus-counter-single">
                  <span class="fa fa-users"></span>
                  <h4 class="counter">{{count($student)}}</h4>
                  <p>Students</p>
                </div>
              </div>
              <!-- End counter item -->
              <!-- Start counter item -->
              <div class="col-lg-3 col-md-3 col-sm-3">
                <div class="mu-abtus-counter-single">
                  <span class="fa fa-building-o"></span>
                  <h4 class="counter">{{count($departments)}}</h4>
                  <p>Departments</p>
                </div>
              </div>
              <!-- End counter item -->
              <!-- Start counter item -->
              <div class="col-lg-3 col-md-3 col-sm-3">
                <div class="mu-abtus-counter-single no-border">
                  <span class="fa fa-user-secret"></span>
                  <h4 class="counter">{{count($tutors)}}</h4>
                  <p>Teachers</p>
                </div>
              </div>
              <!-- End counter item -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End about us counter -->


  <!-- Start latest course section -->
  <section id="mu-latest-courses">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-md-12">
          <div class="mu-latest-courses-area">
           @foreach($course as $c)
           <div class="jumbotron">
           <h2>{{$c->course_name}} </h2>
           <br/>
            <hr>

           Programmes: 
             @foreach($c->programmes as $c_p)
             {{$c_p->programme_name}}
            <br/>
            @endforeach
             Semesters:
              @foreach($c->semesters as $sem)
             {{$sem->semester_name}}
            @endforeach
            <br/>
          </div>
           {{$c->description}}
          @endforeach
        </div>
      </div>
    </div>
  </section>
  <!-- End latest course section -->


  <!-- Start footer -->
  <footer id="mu-footer">
    <!-- start footer top -->
    <div class="mu-footer-top">
      <div class="container">
        <div class="mu-footer-top-area">
          <div class="row">
          
            <div class="col-lg-3 col-md-3 col-sm-3">
              <div class="mu-footer-widget">
                <h4>Contact</h4>
                <address>
                  <p>Royal University of Bhutan</p>
                  <p>Website: www.rub.edu.bt</p>
                  <p>Email: info.rub@gmail.com</p>
                </address>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- end footer top -->
    <!-- start footer bottom -->
    <div class="mu-footer-bottom">
      <div class="container">
        <div class="mu-footer-bottom-area">
          <p>&copy; All Right Reserved. Designed by <a href="http://www.rub.edu.bt/" rel="nofollow">Rub.bt</a></p>
        </div>
      </div>
    </div>
    <!-- end footer bottom -->
  </footer>
  <!-- End footer -->
  
  @endsection