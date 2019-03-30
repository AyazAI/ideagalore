
<link rel="icon" href="favicon.ico" type="image/x-icon"/>
<style>
.loader {
            position: fixed;
            left: 0px;
            top: 0px;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background-color: #ffffffcf;
        }
        .loader img{
            position: relative;
            left: 40%;
            top: 40%;
        }
</style>

<div class="loader" ><img src="{{asset('public/img/loader.gif')}}"></div>

<script>
    window.onload = function() 
    {
        //display loader on page load 
        $('.loader').fadeOut();
    }

</script>