<div class="menubab">
    <div class="container">
        <nav class="setting-menu">
            <a class="@if($page=='Calender') {{ 'active' }} @endif" href="/myCalendar/{{auth()->id()}}">{{ __('frontstaticword.Calender') }}</a>
            <!--<a class="@if($page=='MyLessons') {{ 'active' }} @endif" href="/tutor/lessons/{{auth()->id()}}">{{ __('frontstaticword.MyLessons') }}</a>
            <a class="@if($page=='MyStudents') {{ 'active' }} @endif" href="/myStudents/{{auth()->id()}}">{{ __('frontstaticword.MyStudents') }}</a>-->
            <a class="@if($page=='Statistics') {{ 'active' }} @endif" href="/statistics/{{auth()->id()}}">{{ __('frontstaticword.Statistics') }}</a>
            <a class="@if($page=='UserProfile') {{ 'active' }} @endif" href="/tutor/profile">{{ __('frontstaticword.UserProfile') }}</a>
        </nav>
    </div>
</div>