import React, { useState, useEffect, useRef, forwardRef } from 'react';
import { Stage, Layer, Image } from 'react-konva';
import { makeStyles } from '@material-ui/core/styles';
import Paper from '@material-ui/core/Paper';
import Grid from '@material-ui/core/Grid';
import Alert from '@material-ui/lab/Alert';
import Box from '@material-ui/core/Box';

import './BlockDefinition';
import BlocklyComponent from '../blockly/Blockly';
import exercises from './Data';

const useStyles = makeStyles((theme) => ({
    root: {
      flexGrow: 1,
    },
    paper: {
      padding: theme.spacing(2),
      textAlign: 'center',
      color: theme.palette.text.secondary,
    },
}));

const Maze = forwardRef((props) => {
    const exercise = exercises.find(elem => elem.id === props.match.params.id);
    console.log(props.match.params.id, exercises[0].id);
    const classes = useStyles();
    const [backgroundImg, setBackground] = useState(new window.Image());
    const [goalImg, setGoalImg] = useState(new window.Image());
    const [avatar, setAvatar] = useState(new window.Image());
    const [blockImg, setBlockImg] = useState(new window.Image());
    const [pathImg, setPathImg] = useState(new window.Image());
    const [error, setError] = useState(false);
    let goalNum = exercise.goal.location.length;
    const path = [];

    const avatarRef = useRef();
    const goalRef = exercise.goal.location.map(loc => useRef());

    const resetGame = () => {
        avatarRef.current.to({
            x: exercise.character.location[0],
            y: exercise.character.location[1]
        });
        goalNum = exercise.goal.location.length;
        goalRef.forEach(ref => ref.current.show());
    }

    const verifyMove = (x, y) => {
        if (!path.find((loc) => x === loc[0] && y === loc[1])) {
            setError(true);
            resetGame();
            throw new Error('Invalid move');
        } else {
            const reachedGoalIndex = exercise.goal.location.findIndex((loc) => x === loc[0] * 100 && y === loc[1] * 100);
            if (reachedGoalIndex !== -1) {
                goalNum -= 1;
                goalRef[reachedGoalIndex].current.hide();
            }
        }
    }

    const moveForward = () => {
        avatarRef.current.to({
            x: avatarRef.current.attrs.x + 100,
        });

        verifyMove(avatarRef.current.attrs.x + 100, avatarRef.current.attrs.y);
    }

    const moveBackward = () => {
        avatarRef.current.to({
            x: avatarRef.current.attrs.x - 100,
        });

        verifyMove(avatarRef.current.attrs.x - 100, avatarRef.current.attrs.y);
    }

    const moveUp = () => {
        avatarRef.current.to({
            y: avatarRef.current.attrs.y - 100,
        });

        verifyMove(avatarRef.current.attrs.x, avatarRef.current.attrs.y - 100);
    }

    const moveDown = () => {
        avatarRef.current.to({
            y: avatarRef.current.attrs.y + 100,
        });

        verifyMove(avatarRef.current.attrs.x, avatarRef.current.attrs.y + 100);
    }

    const checkResult = () => {
        if (goalNum === 0) {
            alert('YOU WIN');
            setError(false);
            resetGame();
        } else {
            setError(true);
            resetGame();
        }
    }

    useEffect(() => {
        let img = new window.Image();
        img.src = exercise.background;
        setBackground(img);
        
        img = new window.Image();
        img.src = exercise.character.img;
        setAvatar(img);

        img = new window.Image();
        img.src = exercise.goal.img;
        setGoalImg(img);

        img = new window.Image();
        img.src = exercise.obstacle.img;
        setBlockImg(img);

        img = new window.Image();
        img.src = exercise.path.img;
        setPathImg(img);
    }, []);

    return (
        <div className={classes.root}>
            <Alert variant="filled" severity="info">
                {exercise.instruction}
            </Alert>
            {error && <Alert variant="filled" severity="error">
                Keep coding! Something's not quite right yet.
            </Alert>}
            <Grid container spacing={3}>
                <Grid item xs={6}>
                    <Box display="flex" justifyContent="center" m={1} p={1} bgcolor="background.paper">
                        <Paper className={classes.paper}>
                            <Stage width={800} height={800}>
                                <Layer>
                                    <Image x={0} y={0} image={backgroundImg} />
                                </Layer>
                                <Layer>
                                    {exercise.maze.map((row, i) => {
                                        return row.map((num, j) => {
                                            if (num === 0)
                                                return (
                                                    <Image key={`${j}${i}`} x={j * 100} y={i * 100} image={blockImg} />
                                                );
                                            else {
                                                path.push([j * 100, i * 100]);
                                                return (
                                                    <Image key={`${j}${i}`} x={j * 100} y={i * 100} image={pathImg} />
                                                );
                                            }
                                        });
                                    })}
                                    {exercise.goal.location.map((loc, i) => (
                                        <Image key={`${loc[0]}${loc[1]}`} x={loc[0] * 100} y={loc[1] * 100} image={goalImg} ref={goalRef[i]} />
                                    ))}
                                    <Image x={exercise.character.location[0]} y={exercise.character.location[1]} image={avatar} ref={avatarRef} />
                                </Layer>
                            </Stage>
                        </Paper>
                    </Box>
                </Grid>
                <Grid item xs={6}>
                    <Box display="flex" justifyContent="center" m={1} p={1} bgcolor="background.paper">
                        <Paper className={classes.paper}>
                            <BlocklyComponent functionality={{moveForward, moveBackward, moveUp, moveDown, checkResult}} toolbox={exercise.toolbox} />
                        </Paper>
                    </Box>
                </Grid>
            </Grid>
        </div>
    )
});

export default Maze;