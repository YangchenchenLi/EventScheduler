import Blockly from 'blockly';

Blockly.Blocks['move_forward'] = {
    init: function() {
      this.appendDummyInput()
          .appendField("E")
          .appendField(new Blockly.FieldImage("https://upload.wikimedia.org/wikipedia/commons/thumb/7/71/Arrow_east.svg/800px-Arrow_east.svg.png", 15, 15, { alt: "*", flipRtl: "FALSE" }));
      this.setPreviousStatement(true, null);
      this.setNextStatement(true, null);
      this.setColour(120);
   this.setTooltip("");
   this.setHelpUrl("");
    }
};

Blockly.JavaScript['move_forward'] = function(block) {
  var code = 'functionality.moveForward(); await sleep(500);\n';
  return code;
};

Blockly.Blocks['move_backward'] = {
    init: function() {
      this.appendDummyInput()
          .appendField("W")
          .appendField(new Blockly.FieldImage("https://upload.wikimedia.org/wikipedia/commons/thumb/9/9f/Arrow_west.svg/1280px-Arrow_west.svg.png", 15, 15, { alt: "*", flipRtl: "FALSE" }));
      this.setPreviousStatement(true, null);
      this.setNextStatement(true, null);
      this.setColour(120);
   this.setTooltip("");
   this.setHelpUrl("");
    }
};

Blockly.JavaScript['move_backward'] = function(block) {
    var code = 'functionality.moveBackward(); await sleep(500);\n';
    return code;
};

Blockly.Blocks['move_up'] = {
    init: function() {
      this.appendDummyInput()
          .appendField("N")
          .appendField(new Blockly.FieldImage("https://upload.wikimedia.org/wikipedia/commons/thumb/4/4a/Arrow_north.svg/1200px-Arrow_north.svg.png", 15, 15, { alt: "*", flipRtl: "FALSE" }));
      this.setPreviousStatement(true, null);
      this.setNextStatement(true, null);
      this.setColour(120);
   this.setTooltip("");
   this.setHelpUrl("");
    }
};

Blockly.JavaScript['move_up'] = function(block) {
    var code = 'functionality.moveUp(); await sleep(500);\n';
    return code;
};

Blockly.Blocks['move_down'] = {
    init: function() {
      this.appendDummyInput()
          .appendField("S")
          .appendField(new Blockly.FieldImage("https://upload.wikimedia.org/wikipedia/commons/thumb/f/ff/Arrow_south.svg/242px-Arrow_south.svg.png", 15, 15, { alt: "*", flipRtl: "FALSE" }));
      this.setPreviousStatement(true, null);
      this.setNextStatement(true, null);
      this.setColour(120);
   this.setTooltip("");
   this.setHelpUrl("");
    }
};

Blockly.JavaScript['move_down'] = function(block) {
    var code = 'functionality.moveDown(); await sleep(500);\n';
    return code;
};