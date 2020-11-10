import React from 'react';
import { Link } from 'react-router-dom';
import { makeStyles } from '@material-ui/core/styles';
import List from '@material-ui/core/List';
import ListItem from '@material-ui/core/ListItem';
import ListItemAvatar from '@material-ui/core/ListItemAvatar';
import Avatar from '@material-ui/core/Avatar';
import FolderIcon from '@material-ui/icons/Folder';
import ListItemText from '@material-ui/core/ListItemText';

const useStyles = makeStyles((theme) => ({
    root: {
      flexGrow: 1,
      maxWidth: 752,
    },
    demo: {
      backgroundColor: theme.palette.background.paper,
    },
    title: {
      margin: theme.spacing(4, 0, 2),
    },
  }));

const Dashboard = () => {
    const classes = useStyles();

    const generateElem = () => {
        return [25, 35].map(id => (
            <Link to={`/exercises/${id}`} key={id} >
                <ListItem button>
                    <ListItemAvatar>
                        <Avatar>
                            <FolderIcon />
                        </Avatar>
                    </ListItemAvatar>
                    <ListItemText primary={`Exercise with id ${id}`} />
                </ListItem>
            </Link>
        ));
    }

    return (
        <div className={classes.root}>
            <h3>Exercises</h3>
            <List>
                {generateElem()}
            </List>
        </div>
    )
}

export default Dashboard;