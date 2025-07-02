</div>
<footer class="footer mt-6 py-4 rounded-t-xl">
    
        <div class="container">
            <div class="grid grid-cols-3 gap-4">
                <div>
                &copy; <?php echo date("Y"); ?> <span class="font-bold tracking-wide italic">
                                <span class="text-2xl">Cat</span><span class="text-xs">alog</span>
                            </span>
                </div>
              
                <div class="fmenuwr">
                    <nav class="foot-menu">
                        <?php wp_nav_menu( array('theme_location'  => 'bottom')); ?>
                    </nav>
                </div>

                <div class="slinkwr">
            
                    <a href='http://hit.ua/?x=15878' target='_blank'>
                        <script>
                        Cd=document;Cr="&"+Math.random();Cp="&s=1";
                        Cd.cookie="b=b";if(Cd.cookie)Cp+="&c=1";
                        Cp+="&t="+(new Date()).getTimezoneOffset();
                        if(self!=top)Cp+="&f=1";
                        
                        Cd.write("<img src='//c.hit.ua/hit?i=15878&g=0&x=4"+Cp+Cr+
                        "&r="+escape(Cd.referrer)+"&u="+escape(window.location.href)+
                        "' border='0' width='88' height='15' "+
                        "alt='' />");
                        </script>
                    </a>
                 
                </div>
              
            </div>

        </div>
    
</footer>

<?php wp_footer(); ?>
</body>
</html>