// projects animation

(function () {
  "use strict";

  // projects
  var lava0;
  var ge1doot = {
    screen: {
      elem: null,
      callback: null,
      ctx: null,
      width: 0,
      height: 0,
      left: 0,
      top: 0,
      init: function (id, callback, initRes) {
        this.elem = document.getElementById(id);
        this.callback = callback || null;
        if (this.elem.tagName == "CANVAS")
          this.ctx = this.elem.getContext("2d");
        window.addEventListener(
          "resize",
          function () {
            this.resize();
          }.bind(this),
          false
        );
        this.elem.onselectstart = function () {
          return false;
        };
        this.elem.ondrag = function () {
          return false;
        };
        initRes && this.resize();
        return this;
      },
      resize: function () {
        var o = this.elem;
        this.width = o.offsetWidth;
        this.height = o.offsetHeight;
        for (this.left = 0, this.top = 0; o != null; o = o.offsetParent) {
          this.left += o.offsetLeft;
          this.top += o.offsetTop;
        }
        if (this.ctx) {
          this.elem.width = this.width;
          this.elem.height = this.height;
        }
        this.callback && this.callback();
      },
    },
  };

  var Point = function (x, y) {
    this.x = x;
    this.y = y;
    this.magnitude = x * x + y * y;
    this.computed = 0;
    this.force = 0;
  };

  Point.prototype.add = function (p) {
    return new Point(this.x + p.x, this.y + p.y);
  };

  var Ball = function (parent) {
    var min = 0.1;
    var max = 1.5;
    this.vel = new Point(
      (Math.random() > 0.5 ? 1 : -1) * (0.2 + Math.random() * 0.25),
      (Math.random() > 0.5 ? 1 : -1) * (0.2 + Math.random())
    );
    this.pos = new Point(
      parent.width * 0.2 + Math.random() * parent.width * 0.4,
      parent.height * 0.2 + Math.random() * parent.height * 0.4
    );
    this.size =
      parent.wh / 50 + (Math.random() * (max - min) + min) * (parent.wh / 50);
    this.width = parent.width;
    this.height = parent.height;
  };

  Ball.prototype.move = function () {
    if (this.pos.x >= this.width - this.size) {
      if (this.vel.x > 0) this.vel.x = -this.vel.x;
      this.pos.x = this.width - this.size;
    } else if (this.pos.x <= this.size) {
      if (this.vel.x < 0) this.vel.x = -this.vel.x;
      this.pos.x = this.size;
    }

    if (this.pos.y >= this.height - this.size) {
      if (this.vel.y > 0) this.vel.y = -this.vel.y;
      this.pos.y = this.height - this.size;
    } else if (this.pos.y <= this.size) {
      if (this.vel.y < 0) this.vel.y = -this.vel.y;
      this.pos.y = this.size;
    }

    this.pos = this.pos.add(this.vel);
  };

  var LavaLamp = function (width, height, numBalls, c0, c1) {
    this.step = 5;
    this.width = width;
    this.height = height;
    this.wh = Math.min(width, height);
    this.sx = Math.floor(this.width / this.step);
    this.sy = Math.floor(this.height / this.step);
    this.paint = false;
    this.metaFill = createRadialGradient(width, height, width, c0, c1);
    this.plx = [0, 0, 1, 0, 1, 1, 1, 1, 1, 1, 0, 1, 0, 0, 0, 0];
    this.ply = [0, 0, 0, 0, 0, 0, 1, 0, 0, 1, 1, 1, 0, 1, 0, 1];
    this.mscases = [0, 3, 0, 3, 1, 3, 0, 3, 2, 2, 0, 2, 1, 1, 0];
    this.ix = [1, 0, -1, 0, 0, 1, 0, -1, -1, 0, 1, 0, 0, 1, 1, 0, 0, 0, 1, 1];
    this.grid = [];
    this.balls = [];
    this.iter = 0;
    this.sign = 1;

    for (var i = 0; i < (this.sx + 2) * (this.sy + 2); i++) {
      this.grid[i] = new Point(
        (i % (this.sx + 2)) * this.step,
        Math.floor(i / (this.sx + 2)) * this.step
      );
    }

    for (var k = 0; k < 20; k++) {
      this.balls[k] = new Ball(this);
    }
  };

  LavaLamp.prototype.computeForce = function (x, y, idx) {
    var force;
    var id = idx || x + y * (this.sx + 2);

    if (x === 0 || y === 0 || x === this.sx || y === this.sy) {
      force = 0.6 * this.sign;
    } else {
      force = 0;
      var cell = this.grid[id];
      var i = 0;
      var ball;
      while ((ball = this.balls[i++])) {
        force +=
          (ball.size * ball.size) /
          (-2 * cell.x * ball.pos.x -
            2 * cell.y * ball.pos.y +
            ball.pos.magnitude +
            cell.magnitude);
      }
      force *= this.sign;
    }
    this.grid[id].force = force;
    return force;
  };

  LavaLamp.prototype.marchingSquares = function (next) {
    var x = next[0];
    var y = next[1];
    var pdir = next[2];
    var id = x + y * (this.sx + 2);
    if (this.grid[id].computed === this.iter) {
      return false;
    }
    var dir,
      mscase = 0;

    for (var i = 0; i < 4; i++) {
      var idn = x + this.ix[i + 12] + (y + this.ix[i + 16]) * (this.sx + 2);
      var force = this.grid[idn].force;
      if (
        (force > 0 && this.sign < 0) ||
        (force < 0 && this.sign > 0) ||
        !force
      ) {
        force = this.computeForce(
          x + this.ix[i + 12],
          y + this.ix[i + 16],
          idn
        );
      }
      if (Math.abs(force) > 1) mscase += Math.pow(2, i);
    }
    if (mscase === 15) {
      return [x, y - 1, false];
    } else {
      if (mscase === 5) dir = pdir === 2 ? 3 : 1;
      else if (mscase === 10) dir = pdir === 3 ? 0 : 2;
      else {
        dir = this.mscases[mscase];
        this.grid[id].computed = this.iter;
      }

      var ix =
        this.step /
        (Math.abs(
          Math.abs(
            this.grid[
              x +
                this.plx[4 * dir + 2] +
                (y + this.ply[4 * dir + 2]) * (this.sx + 2)
            ].force
          ) - 1
        ) /
          Math.abs(
            Math.abs(
              this.grid[
                x +
                  this.plx[4 * dir + 3] +
                  (y + this.ply[4 * dir + 3]) * (this.sx + 2)
              ].force
            ) - 1
          ) +
          1);
      ctx.lineTo(
        this.grid[
          x + this.plx[4 * dir] + (y + this.ply[4 * dir]) * (this.sx + 2)
        ].x +
          this.ix[dir] * ix,
        this.grid[
          x +
            this.plx[4 * dir + 1] +
            (y + this.ply[4 * dir + 1]) * (this.sx + 2)
        ].y +
          this.ix[dir + 4] * ix
      );
      this.paint = true;

      return [x + this.ix[dir + 4], y + this.ix[dir + 8], dir];
    }
  };

  LavaLamp.prototype.renderMetaballs = function () {
    var i = 0,
      ball;
    while ((ball = this.balls[i++])) ball.move();

    this.iter++;
    this.sign = -this.sign;
    this.paint = false;
    ctx.fillStyle = this.metaFill;
    ctx.beginPath();

    i = 0;

    while ((ball = this.balls[i++])) {
      var next = [
        Math.round(ball.pos.x / this.step),
        Math.round(ball.pos.y / this.step),
        false,
      ];

      do {
        next = this.marchingSquares(next);
      } while (next);

      if (this.paint) {
        ctx.fill();
        ctx.closePath();
        ctx.beginPath();
        this.paint = false;
      }
    }
  };

  var createRadialGradient = function (w, h, r, c0, c1) {
    var gradient = ctx.createRadialGradient(w / 1, h / 1, 0, w / 1, h / 1, r);
    gradient.addColorStop(0, c0);
    gradient.addColorStop(1, c1);
    return gradient;
  };

  var run = function () {
    requestAnimationFrame(run);
    ctx.clearRect(0, 0, screen.width, screen.height);
    lava0.renderMetaballs();
  };

  var screen = ge1doot.screen.init("bubble", null, true),
    ctx = screen.ctx;
  screen.resize();

  lava0 = new LavaLamp(
    screen.width,
    screen.height,
    6,
    "#cfd3d840",
    "#ff000040"
  );
  run();
})();

// about and projects animation

//noise library
/*
 * A speed-improved perlin and simplex noise algorithms for 2D.
 *
 * Based on example code by Stefan Gustavson (stegu@itn.liu.se).
 * Optimisations by Peter Eastman (peastman@drizzle.stanford.edu).
 * Better rank ordering method by Stefan Gustavson in 2012.
 * Converted to Javascript by Joseph Gentle.
 *
 * Version 2012-03-09
 *
 * This code was placed in the public domain by its original author,
 * Stefan Gustavson. You may use it as you see fit, but
 * attribution is appreciated.
 *
 */

(function (global) {
  var module = (global.noise = {});

  function Grad(x, y, z) {
    this.x = x;
    this.y = y;
    this.z = z;
  }

  Grad.prototype.dot2 = function (x, y) {
    return this.x * x + this.y * y;
  };

  Grad.prototype.dot3 = function (x, y, z) {
    return this.x * x + this.y * y + this.z * z;
  };

  var grad3 = [
    new Grad(1, 1, 0),
    new Grad(-1, 1, 0),
    new Grad(1, -1, 0),
    new Grad(-1, -1, 0),
    new Grad(1, 0, 1),
    new Grad(-1, 0, 1),
    new Grad(1, 0, -1),
    new Grad(-1, 0, -1),
    new Grad(0, 1, 1),
    new Grad(0, -1, 1),
    new Grad(0, 1, -1),
    new Grad(0, -1, -1),
  ];

  var p = [
    151, 160, 137, 91, 90, 15, 131, 13, 201, 95, 96, 53, 194, 233, 7, 225, 140,
    36, 103, 30, 69, 142, 8, 99, 37, 240, 21, 10, 23, 190, 6, 148, 247, 120,
    234, 75, 0, 26, 197, 62, 94, 252, 219, 203, 117, 35, 11, 32, 57, 177, 33,
    88, 237, 149, 56, 87, 174, 20, 125, 136, 171, 168, 68, 175, 74, 165, 71,
    134, 139, 48, 27, 166, 77, 146, 158, 231, 83, 111, 229, 122, 60, 211, 133,
    230, 220, 105, 92, 41, 55, 46, 245, 40, 244, 102, 143, 54, 65, 25, 63, 161,
    1, 216, 80, 73, 209, 76, 132, 187, 208, 89, 18, 169, 200, 196, 135, 130,
    116, 188, 159, 86, 164, 100, 109, 198, 173, 186, 3, 64, 52, 217, 226, 250,
    124, 123, 5, 202, 38, 147, 118, 126, 255, 82, 85, 212, 207, 206, 59, 227,
    47, 16, 58, 17, 182, 189, 28, 42, 223, 183, 170, 213, 119, 248, 152, 2, 44,
    154, 163, 70, 221, 153, 101, 155, 167, 43, 172, 9, 129, 22, 39, 253, 19, 98,
    108, 110, 79, 113, 224, 232, 178, 185, 112, 104, 218, 246, 97, 228, 251, 34,
    242, 193, 238, 210, 144, 12, 191, 179, 162, 241, 81, 51, 145, 235, 249, 14,
    239, 107, 49, 192, 214, 31, 181, 199, 106, 157, 184, 84, 204, 176, 115, 121,
    50, 45, 127, 4, 150, 254, 138, 236, 205, 93, 222, 114, 67, 29, 24, 72, 243,
    141, 128, 195, 78, 66, 215, 61, 156, 180,
  ];
  // To remove the need for index wrapping, double the permutation table length
  var perm = new Array(512);
  var gradP = new Array(512);

  // This isn't a very good seeding function, but it works ok. It supports 2^16
  // different seed values. Write something better if you need more seeds.
  module.seed = function (seed) {
    if (seed > 0 && seed < 1) {
      // Scale the seed out
      seed *= 65536;
    }

    seed = Math.floor(seed);
    if (seed < 256) {
      seed |= seed << 8;
    }

    for (var i = 0; i < 256; i++) {
      var v;
      if (i & 1) {
        v = p[i] ^ (seed & 255);
      } else {
        v = p[i] ^ ((seed >> 8) & 255);
      }

      perm[i] = perm[i + 256] = v;
      gradP[i] = gradP[i + 256] = grad3[v % 12];
    }
  };

  module.seed(0);

  /*
    for(var i=0; i<256; i++) {
      perm[i] = perm[i + 256] = p[i];
      gradP[i] = gradP[i + 256] = grad3[perm[i] % 12];
    }*/

  // Skewing and unskewing factors for 2, 3, and 4 dimensions
  var F2 = 0.5 * (Math.sqrt(3) - 1);
  var G2 = (3 - Math.sqrt(3)) / 6;

  var F3 = 1 / 3;
  var G3 = 1 / 6;

  // 2D simplex noise
  module.simplex2 = function (xin, yin) {
    var n0, n1, n2; // Noise contributions from the three corners
    // Skew the input space to determine which simplex cell we're in
    var s = (xin + yin) * F2; // Hairy factor for 2D
    var i = Math.floor(xin + s);
    var j = Math.floor(yin + s);
    var t = (i + j) * G2;
    var x0 = xin - i + t; // The x,y distances from the cell origin, unskewed.
    var y0 = yin - j + t;
    // For the 2D case, the simplex shape is an equilateral triangle.
    // Determine which simplex we are in.
    var i1, j1; // Offsets for second (middle) corner of simplex in (i,j) coords
    if (x0 > y0) {
      // lower triangle, XY order: (0,0)->(1,0)->(1,1)
      i1 = 1;
      j1 = 0;
    } else {
      // upper triangle, YX order: (0,0)->(0,1)->(1,1)
      i1 = 0;
      j1 = 1;
    }
    // A step of (1,0) in (i,j) means a step of (1-c,-c) in (x,y), and
    // a step of (0,1) in (i,j) means a step of (-c,1-c) in (x,y), where
    // c = (3-sqrt(3))/6
    var x1 = x0 - i1 + G2; // Offsets for middle corner in (x,y) unskewed coords
    var y1 = y0 - j1 + G2;
    var x2 = x0 - 1 + 2 * G2; // Offsets for last corner in (x,y) unskewed coords
    var y2 = y0 - 1 + 2 * G2;
    // Work out the hashed gradient indices of the three simplex corners
    i &= 255;
    j &= 255;
    var gi0 = gradP[i + perm[j]];
    var gi1 = gradP[i + i1 + perm[j + j1]];
    var gi2 = gradP[i + 1 + perm[j + 1]];
    // Calculate the contribution from the three corners
    var t0 = 0.5 - x0 * x0 - y0 * y0;
    if (t0 < 0) {
      n0 = 0;
    } else {
      t0 *= t0;
      n0 = t0 * t0 * gi0.dot2(x0, y0); // (x,y) of grad3 used for 2D gradient
    }
    var t1 = 0.5 - x1 * x1 - y1 * y1;
    if (t1 < 0) {
      n1 = 0;
    } else {
      t1 *= t1;
      n1 = t1 * t1 * gi1.dot2(x1, y1);
    }
    var t2 = 0.5 - x2 * x2 - y2 * y2;
    if (t2 < 0) {
      n2 = 0;
    } else {
      t2 *= t2;
      n2 = t2 * t2 * gi2.dot2(x2, y2);
    }
    // Add contributions from each corner to get the final noise value.
    // The result is scaled to return values in the interval [-1,1].
    return 70 * (n0 + n1 + n2);
  };

  // 3D simplex noise
  module.simplex3 = function (xin, yin, zin) {
    var n0, n1, n2, n3; // Noise contributions from the four corners

    // Skew the input space to determine which simplex cell we're in
    var s = (xin + yin + zin) * F3; // Hairy factor for 2D
    var i = Math.floor(xin + s);
    var j = Math.floor(yin + s);
    var k = Math.floor(zin + s);

    var t = (i + j + k) * G3;
    var x0 = xin - i + t; // The x,y distances from the cell origin, unskewed.
    var y0 = yin - j + t;
    var z0 = zin - k + t;

    // For the 3D case, the simplex shape is a slightly irregular tetrahedron.
    // Determine which simplex we are in.
    var i1, j1, k1; // Offsets for second corner of simplex in (i,j,k) coords
    var i2, j2, k2; // Offsets for third corner of simplex in (i,j,k) coords
    if (x0 >= y0) {
      if (y0 >= z0) {
        i1 = 1;
        j1 = 0;
        k1 = 0;
        i2 = 1;
        j2 = 1;
        k2 = 0;
      } else if (x0 >= z0) {
        i1 = 1;
        j1 = 0;
        k1 = 0;
        i2 = 1;
        j2 = 0;
        k2 = 1;
      } else {
        i1 = 0;
        j1 = 0;
        k1 = 1;
        i2 = 1;
        j2 = 0;
        k2 = 1;
      }
    } else {
      if (y0 < z0) {
        i1 = 0;
        j1 = 0;
        k1 = 1;
        i2 = 0;
        j2 = 1;
        k2 = 1;
      } else if (x0 < z0) {
        i1 = 0;
        j1 = 1;
        k1 = 0;
        i2 = 0;
        j2 = 1;
        k2 = 1;
      } else {
        i1 = 0;
        j1 = 1;
        k1 = 0;
        i2 = 1;
        j2 = 1;
        k2 = 0;
      }
    }
    // A step of (1,0,0) in (i,j,k) means a step of (1-c,-c,-c) in (x,y,z),
    // a step of (0,1,0) in (i,j,k) means a step of (-c,1-c,-c) in (x,y,z), and
    // a step of (0,0,1) in (i,j,k) means a step of (-c,-c,1-c) in (x,y,z), where
    // c = 1/6.
    var x1 = x0 - i1 + G3; // Offsets for second corner
    var y1 = y0 - j1 + G3;
    var z1 = z0 - k1 + G3;

    var x2 = x0 - i2 + 2 * G3; // Offsets for third corner
    var y2 = y0 - j2 + 2 * G3;
    var z2 = z0 - k2 + 2 * G3;

    var x3 = x0 - 1 + 3 * G3; // Offsets for fourth corner
    var y3 = y0 - 1 + 3 * G3;
    var z3 = z0 - 1 + 3 * G3;

    // Work out the hashed gradient indices of the four simplex corners
    i &= 255;
    j &= 255;
    k &= 255;
    var gi0 = gradP[i + perm[j + perm[k]]];
    var gi1 = gradP[i + i1 + perm[j + j1 + perm[k + k1]]];
    var gi2 = gradP[i + i2 + perm[j + j2 + perm[k + k2]]];
    var gi3 = gradP[i + 1 + perm[j + 1 + perm[k + 1]]];

    // Calculate the contribution from the four corners
    var t0 = 0.6 - x0 * x0 - y0 * y0 - z0 * z0;
    if (t0 < 0) {
      n0 = 0;
    } else {
      t0 *= t0;
      n0 = t0 * t0 * gi0.dot3(x0, y0, z0); // (x,y) of grad3 used for 2D gradient
    }
    var t1 = 0.6 - x1 * x1 - y1 * y1 - z1 * z1;
    if (t1 < 0) {
      n1 = 0;
    } else {
      t1 *= t1;
      n1 = t1 * t1 * gi1.dot3(x1, y1, z1);
    }
    var t2 = 0.6 - x2 * x2 - y2 * y2 - z2 * z2;
    if (t2 < 0) {
      n2 = 0;
    } else {
      t2 *= t2;
      n2 = t2 * t2 * gi2.dot3(x2, y2, z2);
    }
    var t3 = 0.6 - x3 * x3 - y3 * y3 - z3 * z3;
    if (t3 < 0) {
      n3 = 0;
    } else {
      t3 *= t3;
      n3 = t3 * t3 * gi3.dot3(x3, y3, z3);
    }
    // Add contributions from each corner to get the final noise value.
    // The result is scaled to return values in the interval [-1,1].
    return 32 * (n0 + n1 + n2 + n3);
  };

  // ##### Perlin noise stuff

  function fade(t) {
    return t * t * t * (t * (t * 6 - 15) + 10);
  }

  function lerp(a, b, t) {
    return (1 - t) * a + t * b;
  }

  // 2D Perlin Noise
  module.perlin2 = function (x, y) {
    // Find unit grid cell containing point
    var X = Math.floor(x),
      Y = Math.floor(y);
    // Get relative xy coordinates of point within that cell
    x = x - X;
    y = y - Y;
    // Wrap the integer cells at 255 (smaller integer period can be introduced here)
    X = X & 255;
    Y = Y & 255;

    // Calculate noise contributions from each of the four corners
    var n00 = gradP[X + perm[Y]].dot2(x, y);
    var n01 = gradP[X + perm[Y + 1]].dot2(x, y - 1);
    var n10 = gradP[X + 1 + perm[Y]].dot2(x - 1, y);
    var n11 = gradP[X + 1 + perm[Y + 1]].dot2(x - 1, y - 1);

    // Compute the fade curve value for x
    var u = fade(x);

    // Interpolate the four results
    return lerp(lerp(n00, n10, u), lerp(n01, n11, u), fade(y));
  };

  // 3D Perlin Noise
  module.perlin3 = function (x, y, z) {
    // Find unit grid cell containing point
    var X = Math.floor(x),
      Y = Math.floor(y),
      Z = Math.floor(z);
    // Get relative xyz coordinates of point within that cell
    x = x - X;
    y = y - Y;
    z = z - Z;
    // Wrap the integer cells at 255 (smaller integer period can be introduced here)
    X = X & 255;
    Y = Y & 255;
    Z = Z & 255;

    // Calculate noise contributions from each of the eight corners
    var n000 = gradP[X + perm[Y + perm[Z]]].dot3(x, y, z);
    var n001 = gradP[X + perm[Y + perm[Z + 1]]].dot3(x, y, z - 1);
    var n010 = gradP[X + perm[Y + 1 + perm[Z]]].dot3(x, y - 1, z);
    var n011 = gradP[X + perm[Y + 1 + perm[Z + 1]]].dot3(x, y - 1, z - 1);
    var n100 = gradP[X + 1 + perm[Y + perm[Z]]].dot3(x - 1, y, z);
    var n101 = gradP[X + 1 + perm[Y + perm[Z + 1]]].dot3(x - 1, y, z - 1);
    var n110 = gradP[X + 1 + perm[Y + 1 + perm[Z]]].dot3(x - 1, y - 1, z);
    var n111 = gradP[X + 1 + perm[Y + 1 + perm[Z + 1]]].dot3(
      x - 1,
      y - 1,
      z - 1
    );

    // Compute the fade curve value for x, y, z
    var u = fade(x);
    var v = fade(y);
    var w = fade(z);

    // Interpolate
    return lerp(
      lerp(lerp(n000, n100, u), lerp(n001, n101, u), w),
      lerp(lerp(n010, n110, u), lerp(n011, n111, u), w),
      v
    );
  };
})(this);

//effective animation code
var wWidth = window.innerWidth;
var wHeight = window.innerHeight;
var scene = new THREE.Scene();
var camera = new THREE.PerspectiveCamera(75, wWidth / wHeight, 0.01, 1000);

var scene2 = new THREE.Scene();
var camera2 = new THREE.PerspectiveCamera(75, wWidth / wHeight, 0.01, 1000);

camera.position.x = 0.1096;
camera.position.y = 5.01;
camera.position.z = 2.68;

camera2.position.x = 0.1096;
camera2.position.y = 5.01;
camera2.position.z = 2.68;

var renderer = new THREE.WebGLRenderer({
  alpha: true,
});
renderer.setClearColor(0x000000, 0);
document.getElementById("sec-graphical-intro").appendChild(renderer.domElement);

var renderer2 = new THREE.WebGLRenderer({
  alpha: true,
});
renderer2.setClearColor(0x000000, 0);
document.getElementById("contact-wave").appendChild(renderer2.domElement);

//Animation parameters
var rows = 100;
var cols = 100;
var perlinScale = 0.07;
var waveSpeed = 0.1;
var waveHeight = 1.5;
var FPS = 25;
var startTime = new Date().getTime();

noise.seed(Math.random());

function createGeometry() {
  var geometry = new THREE.Geometry();
  var heightMap = new Array(rows + 1);
  var vecCount = 0;

  for (var y = 0; y < rows; y++) {
    for (var x = 0; x < cols; x++) {
      geometry.vertices.push(new THREE.Vector3(x, 0, y));

      vecCount += 1;
    }
  }
  geometry.dynamic = true;
  geometry.translate(-50, 0, -25);
  return geometry;
}

var geo = createGeometry();
var pointCloud = new THREE.Points(
  geo,
  new THREE.PointsMaterial({
    size: 0.07,
    color: new THREE.Color("#b1601a"),
  })
);
scene.add(pointCloud);

function perlinAnimate() {
  var curTime = new Date().getTime();
  var i = 0;
  for (var y = 0; y < rows; y++) {
    for (var x = 0; x < cols; x++) {
      pX = x * perlinScale + ((curTime - startTime) / 1000) * waveSpeed;
      pZ = y * perlinScale + ((curTime - startTime) / 1000) * waveSpeed;
      pointCloud.geometry.vertices[i].y = noise.simplex2(pX, pZ) * waveHeight;
      i += 1;
    }
  }
  pointCloud.geometry.verticesNeedUpdate = true;
}

function render() {
  renderer.render(scene, camera);
}

function renderTwo() {
  renderer2.render(scene, camera);
}

function animate() {
  perlinAnimate();
  render();
  renderTwo();
  window.setTimeout(function () {
    requestAnimationFrame(animate);
  }, 1000 / FPS);
}

function refreshCanvasState() {
  wWidth = window.innerWidth;
  wHeight = window.innerHeight;
  camera.aspect = wWidth / wHeight;
  camera.updateProjectionMatrix();
  renderer.setSize(wWidth, wHeight);
  camera2.aspect = wWidth / wHeight;
  camera2.updateProjectionMatrix();
  renderer2.setSize(wWidth, wHeight);
}

//EVENTS && INTERACTIONS
window.addEventListener("resize", refreshCanvasState, false);
animate();
refreshCanvasState();

addEvent(document, "keypress", function (e) {
  e = e || window.event;
  // use e.keyCode
  console.log(e.keyCode);
});

function addEvent(element, eventName, callback) {
  if (element.addEventListener) {
    element.addEventListener(eventName, callback, false);
  } else if (element.attachEvent) {
    element.attachEvent("on" + eventName, callback);
  } else {
    element["on" + eventName] = callback;
  }
}

// experience animation
function animateWithRandomNumber(myClass, from, to) {
  TweenLite.fromTo(
    myClass,
    Math.floor(Math.random() * 20 + 1),
    { y: from },
    {
      y: to,
      onComplete: animateWithRandomNumber,
      onCompleteParams: [myClass, from, to],
      ease: Linear.easeNone,
    }
  );
}

const itemsDown = [
  ".light4",
  ".light5",
  ".light6",
  ".light7",
  ".light8",
  ".light11",
  ".light12",
  ".light13",
  ".light14",
  ".light15",
  ".light16",
].forEach((e) => animateWithRandomNumber(e, -1080, 1080));
const itemsUp = [
  ".light1",
  ".light2",
  ".light3",
  ".light9",
  ".light10",
  ".light17",
].forEach((e) => animateWithRandomNumber(e, 1080, -1080));
