</div>
<footer class="footer mt-6 py-4 rounded-t-xl">
    
        <div class="container">
            <div class="grid grid-cols-3 gap-4">
                <div>
                &copy; 2024-<?php echo date("Y"); ?> <span class="font-bold tracking-wide italic">
                                <span class="text-2xl">Cat</span><span class="text-xs">alog</span>
                            </span>
                </div>
              
                <div>
                    <nav class="text-sm">
                        <?php wp_nav_menu( array('theme_location'  => 'bottom')); ?>
                    </nav>
                </div>

                <div class="slinkwr">

                    <div class="mb-3">
                        <a href='http://hit.ua/?x=15878' target='_blank' rel="nofollow noreferrer">
                            <script>
                            Cd=document;Cr="&"+Math.random();Cp="&s=1";
                            Cd.cookie="b=b";if(Cd.cookie)Cp+="&c=1";
                            Cp+="&t="+(new Date()).getTimezoneOffset();
                            if(self!=top)Cp+="&f=1";
                            
                            Cd.write("<img src='//c.hit.ua/hit?i=15878&g=0&x=4"+Cp+Cr+
                            "&r="+escape(Cd.referrer)+"&u="+escape(window.location.href)+
                            "' border='0' width='88' height='15' "+
                            "alt='hitua' />");
                            </script>
                        </a>
                    </div>

                    <div class="w-10">
                        <a href="https://webstep.top/ua/" target="_blank" title="Розробка і підтримка сайту">
                            <img src="<?php echo get_template_directory_uri(); ?>/img/footprint.svg" alt="webstep">
                        </a>
                    </div>
            
                </div>
            </div>
        </div>
    
</footer>

<?php wp_footer(); ?>
</body>
</html>