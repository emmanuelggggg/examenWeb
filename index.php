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
        var superX=14,superY=10;
        var player=null;
        var playerAmigo1=null;
        var playerAmigo2=null;
        var  pikachu = null;
        var direction='';
        var score=0;
        var speed =10;
        var pausa= false;
        var gameOver= false;
        var obstaculos = [];
        var coordenadas = [
            [0, 0, 10, 1200],[1190, 0, 10, 1200],[0, 0, 1200, 10],
            [0, 1190, 1200, 10],[10, 100, 180, 10],[60, 10, 10, 50],
            [140, 50, 100, 10],[130, 50, 10, 60],[280, 0, 10, 100],
            [230, 50, 10, 250],[60, 150, 10, 150],[70, 150, 110, 10],
            [170, 150, 10, 150],[120, 200, 10, 50],[120, 240, 50, 10],
            [70, 290, 50, 10],[10, 340, 50, 10],[110, 290, 10, 100],
            [60, 390, 160, 10],[170, 340, 120, 10],[220, 350, 10, 100],
            [230, 140, 100, 10], [290, 50, 150, 10],[330, 100, 50, 10],
            [230, 290, 50, 10],[330, 100, 10, 50],[280, 290, 10, 60],
            [430, 50, 10, 110],[430, 100, 50, 10],[480, 100, 10, 60],
            [380, 150, 50, 10],[380, 150, 10, 50],[280, 190, 110, 10],
            [280, 200, 10, 40],[280, 240, 110, 10],[330, 240, 10, 250],
            [280, 390, 50, 10],[220, 440, 50, 10],[490, 50, 50, 10],
            [580, 10, 10, 50],[530, 50, 10, 100],[530, 150, 100, 10],
            [530, 100, 100, 10],[630, 60, 10, 50],[160, 490, 180, 10],
            [60, 440, 100, 10],[160, 440, 10, 50],[60, 450, 10, 50],
            [60, 490, 50, 10],[10, 540, 50, 10],[60, 540, 10, 50],
            [110, 490, 10, 200],[160, 540, 180, 10],[160, 540, 10, 100],
            [170, 630, 50, 10],[10, 880, 50, 10],[60, 640, 10, 200],
            [60, 880, 10, 50],[60, 640, 50, 10],[60, 830, 100, 10],
            [160, 830, 10, 50],[110, 830, 10, 100],[110, 920, 50, 10],
            [110, 740, 10, 50],[110, 730, 50, 10],[160, 690, 10, 100],
            [160, 780, 50, 10],[210, 780, 10, 150],[160, 680, 270, 10],
            [210, 730, 50, 10],[260, 730, 10, 250],[270, 590, 10, 90],
            [330, 550, 10, 80],[330, 590, 50, 10],[380, 500, 10, 100],
            [330, 680, 10, 250],[330, 920, 100, 10],[380, 870, 10, 50],
            [340, 730, 90, 10],[380, 780, 10, 50],[380, 820, 50, 10],
            [430, 820, 10, 50],[430, 870, 50, 10],[480, 870, 10, 110],
            [430, 770, 50, 10],[430, 730, 10, 50],[480, 680, 10, 140],
            [380, 640, 110, 10],[430, 560, 10, 80],[380, 500, 50, 10],
            [330, 440, 50, 10],[380, 340, 10, 110],[430, 200, 10, 310],
            [380, 290, 50, 10],[480, 590, 50, 10],[480, 600, 10, 40],
            [430, 550, 160, 10],[480, 680, 50, 10],[530, 640, 10, 50],
            [530, 640, 60, 10],[580, 550, 10, 100],[480, 820, 160, 10],
            [580, 770, 10, 50],[530, 730, 10, 50],[480, 700, 10, 40],
            [530, 730, 100, 10],[580, 680, 10, 50],[630, 500, 10, 280],
            [480, 500, 10, 50],[430, 440, 100, 10],[530, 390, 10, 110],
            [530, 500, 100, 10],[480, 290, 10, 100],[480, 390, 50, 10],
            [430, 240, 100, 10],[530, 240, 10, 50],[530, 290, 50, 10],
            [530, 340, 50, 10],[580, 290, 10, 160],[580, 390, 60, 10],
            [530, 830, 10, 50],[480, 920, 160, 10],[580, 870, 10, 50],
            [630, 820, 10, 60],[630, 870, 50, 10],[680, 870, 10, 60],
            [580, 210, 10, 50],[630, 210, 10, 140],[630, 50, 160, 10],
            [480, 200, 200, 10],[680, 100, 10, 110],[730, 60, 10, 50],
            [680, 150, 100, 10],[730, 150, 10, 60],[780, 60, 10, 50],
            [780, 100, 100, 10],[830, 10, 10, 50],[880, 50, 10, 60],
            [880, 50, 100, 10],[980, 50, 10, 60],[830, 100, 10, 100],
            [780, 200, 150, 10],[880, 150, 100, 10],[930, 100, 10, 50],
            [980, 150, 10, 50],[980, 200, 50, 10],[630, 290, 100, 10],
            [730, 290, 10, 60],[680, 350, 10, 240],[680, 350, 60, 10],
            [630, 440, 50, 10],[630, 640, 50, 10],[680, 590, 50, 10],
            [720, 600, 10, 80],[640, 680, 90, 10],[680, 500, 60, 10],
            [630, 770, 140, 10],[680, 725, 200, 10],[820, 730, 10, 100],
            [690, 820, 140, 10],[730, 830, 10, 50],[730, 870, 50, 10],
            [680, 920, 300, 10],[820, 870, 10, 50],[820, 870, 50, 10],
            [870, 770, 10, 110],[730, 440, 50, 10],[730, 390, 50, 10],
            [730, 390, 10, 60],[770, 440, 10, 290],[870, 500, 10, 225],
            [830, 640, 50, 10],[830, 640, 50, 10],[820, 640, 10, 40],
            [770, 590, 50, 10],[730, 540, 50, 10],[820, 540, 50, 10],
            [780, 390, 50, 10],[780, 200, 10, 190],[680, 250, 100, 10],
            [830, 250, 10, 150],[830, 250, 50, 10],[820, 440, 10, 50],
            [820, 440, 150, 10],[880, 300, 10, 150],[930, 200, 10, 50],
            [930, 250, 50, 10],[980, 250, 10, 100],[880, 300, 100, 10],
            [930, 350, 10, 50],[930, 390, 100, 10],[970, 440, 10, 200],
            [920, 500, 10, 420],[920, 540, 50, 10],[920, 680, 50, 10],
            [970, 720, 10, 150],[970, 640, 50, 10],[970, 870, 50, 10],
            [0, 980, 1030, 10],[1020, 10, 10, 980]
        ];
        var bg = new Image();
        var pared = new Image();
        var jugadorFrente = new Image();
        var jugadorIzquierda = new Image();
        var jugadorDerecha = new Image();
        var jugadorAtras = new Image();

        var amigo1Frente = new Image();
        var amigo1Izquierda = new Image();
        var amigo1Derecha = new Image();
        var amigo1Atras = new Image();

        var amigo2Frente = new Image();
        var amigo2Izquierda = new Image();
        var amigo2Derecha = new Image();
        var amigo2Atras = new Image();

        var pika = new Image();
        var musicaAmbiental = new Audio();
        
        function start(){

             cv  =document.getElementById('mycanvas');
             ctx  = cv.getContext('2d');

            player =new Cuadraro(superX,superY+5,30,30,'red');
            playerAmigo1 =new Cuadraro(superX-2,superY-20,30,30,'red');
            playerAmigo2 =new Cuadraro(superX-2,superY-40,30,30,'red');
            
            pikachu =new Cuadraro(990,950,40,40,'red');

            bg.src = '/img&sonidos/bgpasto.png';
            pared.src = '/img&sonidos/paredes.png';

            jugadorFrente.src = '/img&sonidos/ashFrente.png';
            jugadorDerecha.src = '/img&sonidos/ashIzquierda.png';
            jugadorIzquierda.src = '/img&sonidos/ahsiz.png';
            jugadorAtras.src = '/img&sonidos/ashAtras.png';

            amigo1Frente.src = '/img&sonidos/amigo1Frente.png';
            amigo1Izquierda.src = '/img&sonidos/amigo1izquierda.png';
            amigo1Derecha.src = '/img&sonidos/amigo1derecha.png';
            amigo1Atras.src = '/img&sonidos/amigo1atras.png';

            amigo2Frente.src = '/img&sonidos/amigo2frente.png';
            amigo2Izquierda.src = '/img&sonidos/amigo2izquierda.png';
            amigo2Derecha.src = '/img&sonidos/amigo2derecha.png';
            amigo2Atras.src = '/img&sonidos/amigo2atras.png';

            pika.src = '/img&sonidos/pikachu.png';
            musicaAmbiental.src = '/img&sonidos/pokemonSound.mp3';

            for (var i = 0; i < 200; i++) {
                var n = new Cuadraro(coordenadas[i][0], coordenadas[i][1], coordenadas[i][2], coordenadas[i][3], "white");
                obstaculos.push(n);
            }
            paint();
        }
        


        document.addEventListener('keydown',function(e){
            //arriba
            if(e.keyCode == 87 || e.keyCode == 38){
                direction='up';
                player.y -=speed;
                playerAmigo1.y -=speed;
                playerAmigo2.y -=speed;

            }
            // abajo
            if(e.keyCode == 83 || e.keyCode == 40){
              direction='down';
              player.y +=speed;
              playerAmigo1.y +=speed;
              playerAmigo2.y +=speed;
              
            }
            // derecha
            if(e.keyCode == 65 || e.keyCode == 37){
               direction='left';
               player.x -=speed;
               playerAmigo1.x -=speed;
               playerAmigo2.x -=speed;
            }
            //abajo
            if(e.keyCode == 68 || e.keyCode == 39){
                 direction='right';
                 player.x +=speed;
                 playerAmigo1.x +=speed;
                 playerAmigo2.x +=speed;
            }
            if(e.keyCode == 32){
                pausa =(pausa)? false : true;
            }
        })
      
        function paint(){
            musicaAmbiental.play();
            window.requestAnimationFrame(paint);
           
            ctx.drawImage(bg,0,0,1400,1000)
           
            ctx.drawImage(jugadorFrente,player.x,player.y,30,35);
            ctx.drawImage(amigo1Frente,playerAmigo1.x,playerAmigo1.y,30,35);
            ctx.drawImage(amigo2Frente,playerAmigo2.x,playerAmigo2.y,30,35);

           ctx.drawImage(pika,pikachu.x,pikachu.y,30,30)

            
            ctx.fillStyle='black';
            ctx.font ="15px Arial"
            ctx.fillText("Score :"+score+"  Speed :"+speed,20,20);

            if(direction == 'right'){
                ctx.drawImage(jugadorDerecha,player.x,player.y,30,30); 
                ctx.drawImage(amigo1Derecha,playerAmigo1.x,playerAmigo1.y,30,30); 
                ctx.drawImage(amigo2Derecha,playerAmigo2.x,playerAmigo2.y,30,30); 
            }
            if(direction == 'left'){
                ctx.drawImage(jugadorIzquierda,player.x,player.y,30,30); 
                ctx.drawImage(amigo1Izquierda,playerAmigo1.x,playerAmigo1.y,30,30); 
                ctx.drawImage(amigo2Izquierda,playerAmigo2.x,playerAmigo2.y,30,30); 
            }
            if(direction == 'down'){
                ctx.drawImage(jugadorFrente,player.x,player.y,30,30);  
                ctx.drawImage(amigo1Frente,playerAmigo1.x,playerAmigo1.y,30,30);  
                ctx.drawImage(amigo2Frente,playerAmigo2.x,playerAmigo2.y,30,30);  
            }
            if(direction == 'up'){
                ctx.drawImage(jugadorAtras,player.x,player.y,30,30); 
                ctx.drawImage(amigo1Atras,playerAmigo1.x,playerAmigo1.y,30,30); 
                ctx.drawImage(amigo2Atras,playerAmigo2.x,playerAmigo2.y,30,30); 
            }

            if(!pausa){
                update();
            }else{
                ctx.fillStyle='rgb(0,0,0,0.5)';
                ctx.fillRect(0,0,1400,1000);

                ctx.fillStyle='white';
                ctx.font ="30px Arial"
                ctx.fillText("P A U S E",700,500);
                musicaAmbiental.pause();
                
            }
            
            for (var i = 0; i < 200; i++) {
                obstaculos[i].dibujar(ctx);
                ctx.drawImage(pared, obstaculos[i].x, obstaculos[i].y, obstaculos[i].w, obstaculos[i].h);
            }
            
            
            
        }
        function update(){
    
            if(player.se_tocan(pikachu)){
                gameOver =(gameOver)? false : true;
                ctx.fillStyle='rgb(0,0,0,0.5)';
                ctx.fillRect(0,0,1400,1000);

                ctx.fillStyle='white';
                ctx.font ="30px Arial"
                ctx.fillText("Encontraste a pikachu",230,230);

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
                    window.setTimeout(callback, 60);
                };
        }());

        // Generate a random number between 2 and 10, including both 2 and 10
        function generateRandomIntegerInRange( max) {
            return Math.floor(Math.random() * (max  + 1));
        }

</script>
</body>
</html>