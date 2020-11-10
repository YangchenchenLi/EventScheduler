import React, { useState } from 'react';
import ReactBlockly from 'react-blockly';
import Blockly from 'blockly';
import Button from '@material-ui/core/Button';

import ConfigFiles from './Config';
import parseWorkspaceXml from './BlocklyHelper';

const CodeEditor = ({functionality, toolbox}) => {
    const toolboxCategories = parseWorkspaceXml(ConfigFiles.INITIAL_TOOLBOX_XML).concat(toolbox);
    const [program, setProgram] = useState();

    const workspaceDidChange = (workspace) => {
        const code = Blockly.JavaScript.workspaceToCode(workspace);
        document.getElementById('code').value = code;
        setProgram(code);
    }

    const sleep = (milliseconds) => {
      return new Promise(resolve => setTimeout(resolve, milliseconds))
    }

    const play = async () => {
      const execution = `(async () => { ${program} })();`;
      try {
        await eval(execution);
      } catch (e) {
        return;
      }
      functionality.checkResult();
    }
    
    return (
      <div>
        <div style={{height: '600px', width: '800px', margin: '10px'}}>
            <ReactBlockly.BlocklyEditor
                toolboxCategories={toolboxCategories}
                workspaceConfiguration={{
                    grid: {
                    spacing: 20,
                    length: 3,
                    colour: '#ccc',
                    snap: true,
                    },
                }}
                initialXml={ConfigFiles.INITIAL_XML}
                wrapperDivClassName="fill-height"
                workspaceDidChange={workspaceDidChange}
            />
        </div>
        <Button variant="contained" color="primary" onClick={async () => {await play()}}>
            PLAY
        </Button>
      </div>
    );
}

export default CodeEditor;