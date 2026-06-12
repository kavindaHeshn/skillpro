<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SkillPro Institute</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        html, body {
            height: 100%;
            font-family: 'Roboto', 'Arial', sans-serif;
            overflow: hidden;
            background: #000;
        }
        canvas {
            display: block;
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
        }
        /* Login Form Styles */
        .login-container {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 380px;
            background: rgba(0, 0, 0, 0.7);
            backdrop-filter: blur(10px);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
            border: 1px solid rgba(255, 255, 255, 0.2);
            z-index: 10;
            color: white;
            text-align: center;
        }
        .login-container h2 {
            font-size: 2.2em;
            margin-bottom: 20px;
            color: #e55a00;
        }
        .login-container p {
            margin-bottom: 30px;
            opacity: 0.9;
        }
        .input-group {
            margin-bottom: 20px;
            text-align: left;
        }
        .input-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
        }
        .input-group input {
            width: 100%;
            padding: 12px 15px;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 8px;
            color: white;
            font-size: 1em;
        }
        .input-group input::placeholder {
            color: rgba(255, 255, 255, 0.6);
        }
        .login-btn {
            width: 100%;
            padding: 14px;
            background: #e55a00;
            border: none;
            border-radius: 8px;
            color: white;
            font-size: 1.1em;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s;
        }
        .login-btn:hover {
            background: #ff6b00;
        }
        .extra-links {
            margin-top: 20px;
        }
        .extra-links a {
            color: #ff6b00;
            text-decoration: none;
            font-size: 0.95em;
        }
        .extra-links a:hover {
            text-decoration: underline;
        }
        /* Random Colors Button (kept from original) */
        a.random-colors {
            position: absolute;
            top: calc(50% + 200px);
            left: 50%;
            transform: translateX(-50%);
            z-index: 10;
            font-family: 'Montserrat', sans-serif;
            font-size: 30px;
            width: 300px;
            height: 50px;
            line-height: 50px;
            text-align: center;
            text-decoration: none;
            background-color: rgba(0, 0, 0, 0.5);
            color: #fff;
            border: 1px solid #fff;
            border-radius: 50px;
        }
    </style>
</head>
<body>
    <div id="app"></div>

    <!-- Login Form Overlay -->
    <div class="login-container">
    <h2>SkillPro Login</h2>
    <p>Welcome back! Please login to your account.</p>

    <form action="../backend/login.php" method="POST">
        <div class="input-group">
            <label for="username">Username or Email</label>
            <input type="text" name="username" id="username"
                   placeholder="Enter your username" required>
        </div>

        <div class="input-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password"
                   placeholder="Enter your password" required>
        </div>

        <button type="submit" class="login-btn">LOGIN</button>
    </form>

    <div class="extra-links">
        <a href="#">Forgot Password?</a> | <a href="sing.php">Register</a>
    </div>
</div>


   
    <script type="module">
        import { createApp } from 'https://unpkg.com/vue@3.0.11/dist/vue.esm-browser.prod.js'
        import { lerp, BufferGeometry, Camera, EffectComposer, Points, Renderer, RenderPass, Scene, ShaderMaterial, Texture, UnrealBloomPass, ZoomBlurPass } from 'https://unpkg.com/troisjs@0.3.0-beta.4/build/trois.module.cdn.min.js'
        import { Clock, Color, MathUtils, Vector3 } from 'https://unpkg.com/three@0.127.0/build/three.module.js'

        const { randFloat: rnd, randInt, randFloatSpread: rndFS } = MathUtils

        const vertexShader = `
          uniform float uTime;
          attribute vec3 color;
          attribute float size;
          varying vec4 vColor;
          void main(){
            vColor = vec4(color, 1.0);
            vec3 p = vec3(position);
            p.z = -150. + mod(position.z + uTime, 300.);
            vec4 mvPosition = modelViewMatrix * vec4( p, 1.0 );
            gl_PointSize = size * (-50.0 / mvPosition.z);
            gl_Position = projectionMatrix * mvPosition;
          }
        `

        const fragmentShader = `
          uniform sampler2D uTexture;
          varying vec4 vColor;
          void main() {
            gl_FragColor = vColor * texture2D(uTexture, gl_PointCoord);
          }
        `

        // Fixed niceColors palette (one beautiful palette from nice-color-palettes)
        const niceColors = [
          ["#ff6b00", "#e55a00", "#d27913", "#f0bc41", "#bc3f0a"] // Orange theme to match your site colors
          // You can add more palettes here if you want
        ];

        createApp({
          template: `
            <Renderer ref="renderer" pointer resize="window" antialias>
              <Camera :position="{ z: 0 }" :fov="50" />
              <Scene background="#000000">
                <Points ref="points" :position="{ z: -150 }">
                  <BufferGeometry :attributes="attributes" />
                  <ShaderMaterial :blending="2" :depth-test="false" :uniforms="uniforms" :vertex-shader="vertexShader" :fragment-shader="fragmentShader">
                    <Texture src="https://assets.codepen.io/33787/sprite.png" uniform="uTexture" />
                  </ShaderMaterial>
                </Points>
              </Scene>
              <EffectComposer>
                <RenderPass />
                <UnrealBloomPass :strength="2" :radius="0" :threshold="0" />
                <ZoomBlurPass :strength="zoomStrength" />
              </EffectComposer>
            </Renderer>
          `,
          components: { BufferGeometry, Camera, EffectComposer, Points, Renderer, RenderPass, Scene, ShaderMaterial, Texture, UnrealBloomPass, ZoomBlurPass },
          setup() {
            const POINTS_COUNT = 50000
            const palette = niceColors[0] // Use first palette (orange theme)
            const positions = new Float32Array(POINTS_COUNT * 3)
            const colors = new Float32Array(POINTS_COUNT * 3)
            const sizes = new Float32Array(POINTS_COUNT)
            const v3 = new Vector3(), color = new Color()
            for (let i = 0; i < POINTS_COUNT; i++) {
              v3.set(rndFS(200), rndFS(200), rndFS(300))
              v3.toArray(positions, i * 3)
              color.set(palette[Math.floor(rnd(0, palette.length))])
              color.toArray(colors, i * 3)
              sizes[i] = rnd(5, 20)
            }
            const attributes = [
              { name: 'position', array: positions, itemSize: 3 },
              { name: 'color', array: colors, itemSize: 3 },
              { name: 'size', array: sizes, itemSize: 1 },
            ]
            const uniforms = { uTime: { value: 0 } }
            const clock = new Clock()
            let timeCoef = 1
            let targetTimeCoef = 1
            return {
              POINTS_COUNT,
              attributes, uniforms, vertexShader, fragmentShader,
              clock, timeCoef, targetTimeCoef,
            }
          },
          data() {
            return {
              zoomStrength: 0,
            }
          },
          mounted() {
            const renderer = this.$refs.renderer
            const positionN = renderer.three.pointer.positionN
            const points = this.$refs.points.points
            renderer.onBeforeRender(() => {
              this.timeCoef = lerp(this.timeCoef, this.targetTimeCoef, 0.02)
              this.uniforms.uTime.value += this.clock.getDelta() * this.timeCoef * 4
              this.zoomStrength = this.timeCoef * 0.004
              const da = 0.05
              const tiltX = lerp(points.rotation.x, positionN.y * da, 0.02)
              const tiltY = lerp(points.rotation.y, -positionN.x * da, 0.02)
              points.rotation.set(tiltX, tiltY, 0)
            })
          },
          methods: {
            updateColors() {
              const colorAttribute = this.$refs.points.geometry.attributes.color
              const palette = niceColors[0] // Change index for different palettes if you add more
              const color = new Color()
              for (let i = 0; i < this.POINTS_COUNT; i++) {
                color.set(palette[randInt(0, palette.length)])
                color.toArray(colorAttribute.array, i * 3)
              }
              colorAttribute.needsUpdate = true
            },
            login() {
              alert('Login functionality - connect to your backend here!')
              // Add your actual login logic (e.g., fetch to PHP backend)
            }
          },
        }).mount('#app')
    </script>
</body>
</html>