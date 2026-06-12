<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - SkillPro Institute</title>
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
        /* Register Form Styles */
        .register-container {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 420px;
            max-height: 90vh;
            overflow-y: auto;
            background: rgba(0, 0, 0, 0.7);
            backdrop-filter: blur(12px);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.6);
            border: 1px solid rgba(255, 255, 255, 0.2);
            z-index: 10;
            color: white;
            text-align: center;
        }
        .register-container h2 {
            font-size: 2.4em;
            margin-bottom: 10px;
            color: #e55a00;
        }
        .register-container p {
            margin-bottom: 30px;
            opacity: 0.9;
            font-size: 1.05em;
        }
        .input-group {
            margin-bottom: 18px;
            text-align: left;
        }
        .input-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
        }
        .input-group input,
        .input-group select {
            width: 100%;
            padding: 12px 15px;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 8px;
            color: white;
            font-size: 1em;
        }
        .input-group input::placeholder,
        .input-group select::placeholder {
            color: rgba(255, 255, 255, 0.6);
        }
        .input-group select {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath fill='%23ffffff' d='M1.5 0L6 4.5 10.5 0 12 1.5 6 7.5 0 1.5z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 15px center;
        }
        .row {
            display: flex;
            gap: 15px;
        }
        .row .input-group {
            flex: 1;
        }
        .register-btn {
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
            margin-top: 10px;
        }
        .register-btn:hover {
            background: #ff6b00;
        }
        .extra-links {
            margin-top: 25px;
            font-size: 0.95em;
        }
        .extra-links a {
            color: #ff6b00;
            text-decoration: none;
        }
        .extra-links a:hover {
            text-decoration: underline;
        }
        /* Random Colors Button */
        a.random-colors {
            position: absolute;
            top: calc(50% + 260px);
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
        /* Scrollbar for mobile */
        .register-container::-webkit-scrollbar {
            width: 8px;
        }
        .register-container::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <div id="app"></div>

    <!-- Register Form Overlay -->
    <div class="register-container">
    <h2>Create Account</h2>
    <p>Join SkillPro Institute and start your journey today!</p>

    <form method="POST" action="../backend/register.php">

        <div class="row">
            <div class="input-group">
                <label for="firstName">First Name</label>
                <input type="text" id="firstName" name="firstName"
                       placeholder="Enter first name" required>
            </div>

            <div class="input-group">
                <label for="lastName">Last Name</label>
                <input type="text" id="lastName" name="lastName"
                       placeholder="Enter last name" required>
            </div>
        </div>

        <div class="input-group">
            <label for="email">Email Address</label>
            <input type="email" id="email" name="email"
                   placeholder="example@domain.com" required>
        </div>

        <div class="input-group">
            <label for="phone">Phone Number</label>
            <input type="tel" id="phone" name="phone"
                   placeholder="+94 XX XXX XXXX" required>
        </div>

        <div class="input-group">
            <label for="role">I am a...</label>
            <select id="role" name="role" required>
                <option value="" disabled selected>Select your role</option>
                <option value="student">Student</option>
                <option value="instructor">Instructor</option>
                <option value="staff">Staff / Admin</option>
            </select>
        </div>

        <div class="input-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password"
                   placeholder="Create a strong password" required>
        </div>

        <div class="input-group">
            <label for="confirmPassword">Confirm Password</label>
            <input type="password" id="confirmPassword" name="confirmPassword"
                   placeholder="Re-enter password" required>
        </div>

        <button type="submit" class="register-btn">REGISTER NOW</button>
    </form>

    <div class="extra-links">
        Already have an account? <a href="login.php">Login here</a>
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

        const niceColors = [
          ["#ff6b00", "#e55a00", "#d27913", "#f0bc41", "#bc3f0a"]
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
            const palette = niceColors[0]
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
              const palette = niceColors[0]
              const color = new Color()
              for (let i = 0; i < this.POINTS_COUNT; i++) {
                color.set(palette[randInt(0, palette.length)])
                color.toArray(colorAttribute.array, i * 3)
              }
              colorAttribute.needsUpdate = true
            },
            register() {
              // Basic client-side validation example
              const password = document.getElementById('password').value
              const confirmPassword = document.getElementById('confirmPassword').value
              if (password !== confirmPassword) {
                alert('Passwords do not match!')
                return
              }
              alert('Registration successful! (Connect to your backend here)')
              // Here you can send data to PHP backend via fetch/AJAX
            }
          },
        }).mount('#app')
    </script>
</body>
</html>