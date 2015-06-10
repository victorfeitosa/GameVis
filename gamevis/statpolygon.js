define(function (require) {

	var gamevis = require('gamevis/gamevis.min-');

	//Status polygon graph element
	//@attr: canvas, stats, radius, maxVal, x, y, fill, stroke, stroke_width, fill_op, stroke_op
	function StatPolygon(obj) {
		//Attributes------------------------------------------------------------
		this.ClassType = 'StatPolygon';

		if (obj) {
			this.Canvas = obj.canvas;
			this.Stats = obj.stats;
			this.Radius = obj.radius || 10;
			this.X = obj.x || 0;
			this.Y = obj.y || 0;
			this.Fill = obj.fill || 'blue';
			this.PolygonFill = obj.polygon_fill || 'red';
			this.Stroke = obj.stroke || 'dark-blue';
			this.StrokeWidth = obj.stroke_width || 1;
			this.FillOpacity = obj.fill_op || 255;
			this.PolygonOpacity = obj.polygon_opacity || 1;
			this.StrokeOpacity = obj.stroke_op || 255;
			this.TextFill = obj.text_fill || 'red';
			this.TextOpacity = obj.text_op || 1;
			this.TextStroke = obj.text_stroke || 'red';
			this.TextStrokeWidth = obj.text_stroke || 0;
			this.TextStrokeOpacity = obj.text_stroke_op || 1;
			this.TextFontFaminly = obj.text_font || 'Sans-serif';
			this.TextFontSize = obj.text_font_size || 14;
			this.MaxVal = obj.maxVal || 100;
			this.Transition = obj.transition;
			this.Spacing = obj.spacing || 4;
			this.Option = obj.options || {};
		} else if (DEBUG)
			throw ': Argument object not defined in ' + this.ClassType;

		this.NSides = 0;
		this.Group = null;
		this.Polygon = null;
		this.Poly = null;
		this.Ticks = null;
		this.StatText = null;
		this.CircleArea = null;

		for (var i in this.Stats) {
			if (this.Stats.hasOwnProperty(i))
				++this.NSides;
		}
	}

	//Methods------------------------------------------------------------------
	StatPolygon.prototype.append = function () {
		var self = this;

		console.log(self.Canvas);

		self.Group = self.Canvas.append('g').classed('stat-polygon-group',
			true);
		self.CircleArea = self.Group.append('g').classed(
			'stat-polygon-circlegroup', true);
		self.Polygon = self.Group.append('g').classed(
			'stat-polygon-polygroup',
			true);
		self.Poly = self.Polygon.append('g');
		self.Ticks = self.Polygon.append('g').classed('stat-polygon-ticks',
			true);
		self.StatText = self.Group.append('g').classed('stat-polygon-texts',
			true);

		//attatch the outter circle area with its stroke (fill maybe?)
		var circle = this.CircleArea.append('circle')
			.attr('cx', this.X)
			.attr('cy', this.Y)
			.attr('r', this.Radius)
			.classed('stat-polygon-circle', true);
		self.CircleArea.append('circle')
			.attr('cx', this.X)
			.attr('cy', this.Y)
			.attr('r', 2 * (this.Radius / 3))
			.classed('stat-polygon-circle', true);
		self.CircleArea.append('circle')
			.attr('cx', this.X)
			.attr('cy', this.Y)
			.attr('r', this.Radius / 3)
			.classed('stat-polygon-circle', true);
		self.CircleArea.append('circle')
			.attr('cx', this.X)
			.attr('cy', this.Y)
			.attr('r', 2)
			.classed('stat-polygon-circle', true);

		//attatch the polygon points lines
		var i = 0;
		for (var j in self.Stats) {
			var linegroup = self.CircleArea.append('g')
				.append('line')
				.classed('stat-polygon-line', true)
				.attr('x1', 0)
				.attr('y1', 0)
				.attr('x2', self.Radius)
				.attr('y2', 0);
			linegroup.attr('transform', function () {
				var angle = (360 / self.NSides) * i;
				angle += 90;
				return 'translate(' + self.X + ',' + self.Y + ')' + 'rotate(' +
					angle +
					')';
			});
			i++;
		}

		//attatch the inner polygon area with fill and stroke
		var points = [];
		i = 0;
		for (var j in self.Stats) {
			var angle = (360 / self.NSides) * i;
			angle += 90;
			angle = (angle * Math.PI) / 180; //conversion to radian
			var val = (self.Stats[j] * self.Radius) / self.MaxVal;

			var px = Math.cos(angle) * val;
			var py = Math.sin(angle) * val;

			points.push(px);
			points.push(py);

			var tick = new gamevis.graphics.Dot({
				canvas: self.Ticks,
				x: px + self.X,
				y: py + self.Y,
				radius: 3
			}).classed(
				'point' + i, true).classed('stat-polygon-circle', true);

			i++;
		}

		self.Poly.attr('transform', function () {
				return 'translate(' + self.X + ',' + self.Y + ')';
			})
			.append('polygon')
			.attr('points', points)
			.classed('stat-polygon-poly', true);

		//attatch tooltips if option is set
		// if (self.Option['AttatchStatsTooltips'] === true) {
		self.Ticks.selectAll('circle').data(Object.keys(self.Stats))
			.each(function (d, i) {
				var tick = d3.select(this);
				var tip = new gamevis.graphics.ToolTip({
						parent: tick,
						tiphtml: d,
						x: tick.attr('cx'),
						y: tick.attr('cy')
					})
					.classed('tooltip', true)
					.on('mouseover', function () {
						tip.transition().style('opacity', 0.9);
					}).on('mouseout', function () {
						tip.transition().style('opacity', 0);
					});
			});
		// }
		// //if option is not set put stats as text
		// else{

		//Attatchs the text stat name
		var stattexts = self.StatText.selectAll('g')
			.data(Object.keys(self.Stats))
			.enter()
			.append('text')
			.classed('stat-polygon-text-element', true)
			.attr('transform', function (d, i) {
				var angle = (360 / self.NSides) * i;
				angle += 90;
				var rad = (angle * Math.PI) / 180;
				var val = self.Radius + (d.length * self.Spacing);

				var px = (Math.cos(rad) * val) + self.X;
				var py = (Math.sin(rad) * val) + self.Y;

				if (angle > 90 && angle < 270)
					angle += 180;
				if (angle < -90 && angle > -270)
					angle -= 180;
				return 'translate(' + px + ',' + py + ')' + 'rotate(' + (angle) +
					')';
			})
			.text(function (d) {
				return d;
			});
		// }

		if (gamevis.data.isStyleSourceCode()) {
			//set resources color and all
			self.Group.selectAll('circle')
				.style('fill', this.Fill)
				.style('stroke', this.Stroke)
				.style('stroke-width', this.StrokeWidth)
				.style('fill-opacity', this.FillOpacity)
				.style('stroke-opacity', this.StrokeOpacity);
			self.Group.selectAll('line')
				.style('stroke', this.Stroke)
				.style('stroke-width', this.StrokeWidth)
				.style('stroke-opacity', this.StrokeOpacity);
			self.Group.selectAll('polygon')
				.style('fill', this.PolygonFill)
				.style('stroke', this.Stroke)
				.style('stroke-width', this.StrokeWidth)
				.style('fill-opacity', this.PolygonOpacity)
				.style('stroke-opacity', this.StrokeOpacity);
			self.Group.selectAll('text')
				.style('fill', this.TextFill)
				.style('fill-opacity', this.TextOpacity)
				.style('stroke', this.TextStroke)
				.style('stroke-width', this.TextStrokeWidth)
				.style('stroke-opacity', this.TextStrokeOpacity)
				.style('font-family', this.TextFamilyFont)
				.style('font-size', this.TextFontSize);
		}

		return self;
	};

	StatPolygon.prototype.get = function (element) {
		if (element)
			return this.Group.selectAll(element);
		return this.Group;
	};

	StatPolygon.prototype.transition = function (element, filter) {
		if (filter)
			return this.get(element).filter(filter).transition();
		return this.get(element).transition();
	};

	StatPolygon.prototype.remove = function () {

	};

	gamevis.graphics.StatPolygon = StatPolygon;

	return StatPolygon;
});
