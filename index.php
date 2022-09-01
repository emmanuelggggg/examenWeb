<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <style>
        
    </style>
    <canvas id=mycanvas width="1400px;" height="1000px;">
        
    </canvas>

    <script>
      var cv  =null;
        var ctx  = null;
        var superX=240,superY=240;
        var player=null
        var  player2 = null;
        var direction='';
        var score=0;
        var speed =4;
        var pausa= false;
        var obstaculos = new Array(3);

        var bg = new Image();
        var pared = new Image();
        var jugadorFrente = new Image();
        var jugadorIzquierda = new Image();
        var jugadorDerecha = new Image();
        var jugadorAtras = new Image();

        function start(){

             cv  =document.getElementById('mycanvas');
             ctx  = cv.getContext('2d');

            player =new Cuadraro(superX,superY,40,40,'red');
    


            player2 =new Cuadraro(generateRandomIntegerInRange(500),
            generateRandomIntegerInRange(100),40,40,'red');

            obstaculos[0]= new Cuadraro(100,50,120,30);
            obstaculos[1]= new Cuadraro(50,300,30,120);
            obstaculos[2]= new Cuadraro(400,200,30,120);

            bg.src = '/img&sonidos/bgpasto.png';
            pared.src = '/img&sonidos/paredes.png';

            jugadorFrente.src = '/img&sonidos/ashFrente.png';
            jugadorDerecha.src = '/img&sonidos/ashIzquierda.png';
            jugadorIzquierda.src = '/img&sonidos/ahsiz.png';
            jugadorAtras.src = '/img&sonidos/ashAtras.png';
             paint();
        }
        


        document.addEventListener('keydown',function(e){
            // console.log(e);
            //arriba
            if(e.keyCode == 87 || e.keyCode == 38){
                direction='up';

            }
            // abajo
            if(e.keyCode == 83 || e.keyCode == 40){
              direction='down';
            }
            // derecha
            if(e.keyCode == 65 || e.keyCode == 37){
               direction='left';
            }
            //abajo
            if(e.keyCode == 68 || e.keyCode == 39){
                 direction='right';
            }
            if(e.keyCode == 32){
                pausa =(pausa)? false : true;
            }
        })
        document.addEventListener('keyup',function(e){
            // console.log(e);
            //arriba
            if(e.keyCode == 87 || e.keyCode == 38){
                direction='up';
                speed =0;

            }
            // abajo
            if(e.keyCode == 83 || e.keyCode == 40){
              direction='down';
              speed =0;
            }
            // derecha
            if(e.keyCode == 65 || e.keyCode == 37){
               direction='left';
               speed =0;
            }
            //abajo
            if(e.keyCode == 68 || e.keyCode == 39){
                 direction='right';
                 speed =0;
            }
           
        })
        function paint(){

            window.requestAnimationFrame(paint);
            ctx.drawImage(bg,0,0,1400,1000)
           
            
            if(direction == 'right'){
                ctx.drawImage(jugadorDerecha,player.x,player.y,50,55); 
                
            }
            if(direction == 'left'){
                ctx.drawImage(jugadorIzquierda,player.x,player.y,50,55); 
               
            }
            if(direction == 'down'){
                ctx.drawImage(jugadorFrente,player.x,player.y,50,55);  
            }
            if(direction == 'up'){
                ctx.drawImage(jugadorAtras,player.x,player.y,50,55); 
                 
            }
          

            player2.dibujar(ctx);

            
            ctx.fillStyle='black';
            ctx.font ="15px Arial"
            ctx.fillText("Score :"+score+"  Speed :"+speed,20,20);

     
            if(!pausa){
                update();
            }else{
                ctx.fillStyle='rgb(0,0,0,0.5)';
                ctx.fillRect(0,0,500,500);

                ctx.fillStyle='white';
                ctx.font ="30px Arial"
                ctx.fillText("P A U S E",230,230);
                
            }
            
            ctx.drawImage(pared,obstaculos[0].x,obstaculos[0].y,120,30);
            ctx.drawImage(pared,obstaculos[1].x,obstaculos[1].y,30,120);
            ctx.drawImage(pared,obstaculos[2].x,obstaculos[2].y,30,120);
            
            
            
            
        }
        function update(){
            
            if(direction == 'right'){
                player.x +=speed;
            }
            if(direction == 'left'){
                player.x -=speed;
            }
            if(direction == 'down'){
                player.y +=speed;
            }
            if(direction == 'up'){
                player.y -=speed;
            }
           
            if(player.se_tocan(player2)){

                player2.x=generateRandomIntegerInRange(500);
                player2.y=generateRandomIntegerInRange(500);

                score += 5;
                speed +=0.3;

            }
        
            
            
              
        }
        function Cuadraro(x,y,w,h,c){
            this.x = x;
            this.y = y;
            this.w = w;
            this.h = h;
            this.c = c;

            this.dibujar = function(ctx){
                ctx.fillStyle=this.c;
                ctx.fillRect(this.x,this.y,this.w,this.h);
                ctx.strokeRect(this.x,this.y,this.w,this.h);
            }
            this.se_tocan = function (target) { 
                if(this.x < target.x + target.w &&
                    this.x + this.w > target.x && 
                    this.y < target.y + target.h && 
                    this.y + this.h > target.y) {

                     return true;  
                }  

            };
            
        }
        window.addEventListener('load',start)
        window.requestAnimationFrame = (function () {
            return window.requestAnimationFrame ||
                window.webkitRequestAnimationFrame ||
                window.mozRequestAnimationFrame ||
                function (callback) {
                    window.setTimeout(callback, 17);
                };
        }());

        // Generate a random number between 2 and 10, including both 2 and 10
        function generateRandomIntegerInRange( max) {
            return Math.floor(Math.random() * (max  + 1));
        }

</script>
</body>
</html>