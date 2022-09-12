@component('mail::message')
# Welcome, {{$tutor->fname}} !!
<div class="complete">
        <div class="photo"><img src="https://arabie.live/frontAssets/images/tutor.png" alt="Arabia" title="Arabia"></div>
        <h1 class="title">complete your profile</h1>
        <p class="text">Hi {{$tutor->fname}}, ready to start earning on Arabie?<br/> Add your description, and you’ll be one step<br/> closer to teaching!
        </p>
        <a class="bottom" href="https://arabie.live/tutor/profile">Finish your profile</a>
    </div>
<!-- End complete -->
<div class="strong-profile">
        <h2 class="title">3 Tips for Strong Profile</h2>
        <div class="profile-item">
            <div class="col">
                <div class="photo">
                    <img src="https://arabie.live/frontAssets/images/bg-photo.png" alt="Arabia" title="Arabia">
                    <a class="bla-2 cd-single-point" href="#"> <i class="cd-img-replace"> </i> <svg width="23" height="29" viewBox="0 0 23 29" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0.835352 0.998526C0.479041 1.20118 0.258911 1.57953 0.258911 1.98921V26.9983C0.258911 27.6277 0.769257 28.1379 1.3985 28.1379C2.02774 28.1379 2.53809 27.6277 2.53809 26.9983V3.99394L19.4103 14.0381L7.00319 22.0317C6.47423 22.3727 6.32152 23.0779 6.66245 23.6069C7.00356 24.136 7.70859 24.2887 8.23774 23.9476L22.191 14.9576C22.5227 14.7439 22.7202 14.3739 22.7132 13.9794C22.7061 13.5849 22.4957 13.2221 22.1567 13.0203L1.9814 1.00992C1.62889 0.800427 1.19166 0.795869 0.835352 0.998526Z" fill="#fff"></path>
                        </svg></a>
                </div>
            </div>
            <div class="col">
                <h2 class="title">Tips for an amazing video</h2>
                <p class="text">Keep your video under 2 minutes , Record in a horizontal mode , Greet your student warmly , Highlight any teaching certification . </p>
                <a class="bottom" href="https://arabie.live/tutor/profile">Learn more</a>
            </div>
        </div>
        <!-- End profile-item -->
        <div class="profile-item pro-item">
            <div class="col">
                <h2 class="title">Tips for an amazing photo</h2>
                <p class="text">Smile and look at the camera , Frame your head and shoulders , Your photo is centered and upright , Use neutral lighting and background . </p>
                <a class="bottom" href="https://arabie.live/tutor/profile">Learn more</a>
            </div>
            <div class="col">
                <div class="photo">
                    <img src="https://arabie.live/frontAssets/images/profile-1.png" alt="Arabia" title="Arabia">
                </div>
            </div>
        </div>
        <!-- End profile-item -->
<div class="profile-item nopad">
            <div class="col">
                <div class="photo">
                    <img src="https://arabie.live/frontAssets/images/item.jpg" alt="Arabia" title="Arabia">
                </div>
            </div>
            <div class="col">
                <h2 class="title">Start with a catchy headline</h2>
                <p class="text">Make it 50-75 characters and highlight your specialty. Check out other tutors’ profiles for inspiration </p>
                <a class="bottom" href="https://arabie.live/tutor/profile">Learn more</a>
            </div>
</div>
        <!-- End profile-item -->
        <div class="text-center">
            <a class="bottom" href="https://arabie.live/tutor/profile">Finish your profile</a>
        </div>
    </div>
    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
