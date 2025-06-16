<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Super Keren Login</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <style>
        html, body {
            margin: 0;
            padding: 0;
            height: 100%;
            overflow: hidden;
            font-family: 'Figtree', sans-serif;
            background: #000;
        }

        #particleCanvas {
            position: absolute;
            top: 0;
            left: 0;
            z-index: 0;
        }

        .login-wrapper {
            position: relative;
            z-index: 1;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-box {
            /* Tambahan lebar */
            width: 100%;
            max-width: 520px; /* sebelumnya 400px, sekarang lebih lebar */
        }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body>
    <!-- Canvas Particles Background -->
    <canvas id="particleCanvas"></canvas>

    <!-- Login Form Container -->
    <div class="login-wrapper">
        <div class="login-box">
            {{ $slot }}
        </div>
    </div>

    <!-- JavaScript Canvas Particle Animation -->
    <script>
        const canvas = document.getElementById("particleCanvas");
        const ctx = canvas.getContext("2d");

        let width, height;
        const particles = [];

        function resizeCanvas() {
            width = canvas.width = window.innerWidth;
            height = canvas.height = window.innerHeight;
        }

        window.addEventListener("resize", resizeCanvas);
        resizeCanvas();

        class Particle {
            constructor() {
                this.reset();
            }

            reset() {
                this.x = Math.random() * width;
                this.y = Math.random() * height;
                this.radius = Math.random() * 2 + 1;
                this.alpha = Math.random() * 0.3 + 0.1;
                this.speedX = (Math.random() - 0.5) * 0.5;
                this.speedY = (Math.random() - 0.5) * 0.5;
            }

            update() {
                this.x += this.speedX;
                this.y += this.speedY;

                if (this.x < 0 || this.x > width || this.y < 0 || this.y > height) {
                    this.reset();
                }
            }

            draw(ctx) {
                ctx.beginPath();
                ctx.arc(this.x, this.y, this.radius, 0, 2 * Math.PI);
                ctx.fillStyle = `rgba(255, 255, 255, ${this.alpha})`;
                ctx.fill();
            }
        }

        for (let i = 0; i < 300; i++) {
            particles.push(new Particle());
        }

        function animate() {
            ctx.clearRect(0, 0, width, height);
            particles.forEach(p => {
                p.update();
                p.draw(ctx);
            });
            requestAnimationFrame(animate);
        }

        animate();
    </script>

</body>
</html>
