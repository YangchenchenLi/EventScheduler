const exercises = [
    {
        "id": "25",
        "level" : "A2",
        "created_at" : "2014-10-31T18:21:15.000Z",
        "character": {
            "id" : 3,
            "location" : [0, 0],
            "img" : "https://res.cloudinary.com/builtquick/image/upload/v1594597582/avatar_qv7rjk.png",
            "forward" : "../images/forward.gif",
            "backward" : "../images/backward.gif",
            "up" : "../images/up.gif",
            "down" : "../images/down.gif",
            "success" : "../images/success.gif",
            "failure" : "../images/failure.gif"
        },
        "goal" : {
            "id" : 2,
            "location": [[6, 0]],
            "img" : "https://res.cloudinary.com/builtquick/image/upload/v1594597582/goal_oq1aba.png"
        },
        "obstacle" : {
            "id" : 0,
            "img" : "https://res.cloudinary.com/builtquick/image/upload/v1594597581/tile_e01hvh.png"
        },
        "path" : {
            "id": 1,
            "img" : "https://res.cloudinary.com/builtquick/image/upload/v1594598713/path_scyovz.png"
        },
        "background" : "https://res.cloudinary.com/builtquick/image/upload/v1594597582/background_vmgo7l.png",
        "instruction" : "Can you add just a few blocks to help me solve a more complex maze? If you do it right, I can walk any curvy path no matter the length. Hurry! The ice is melting!",
        "maze" : [[1, 1, 1, 1, 1, 1, 1, 0], [0, 0, 0, 0, 0, 0, 0, 0], [0, 0, 0, 0, 0, 0, 0, 0], [0, 0, 0, 0, 0, 0, 0, 0], [0, 0, 0, 0, 0, 0, 0, 0], [0, 0, 0, 0, 0, 0, 0, 0], [0, 0, 0, 0, 0, 0, 0, 0], [0, 0, 0, 0, 0, 0, 0, 0]], 
        "toolbox" : [
            {
                name: 'Actions',
                colour: '#5C81A6',
                blocks: [
                { type: 'move_forward' },
                { type: 'move_backward' },
                { type: 'move_up' },
                { type: 'move_down' }
                ],
            },
        ],
    },
    {
        "id": "35",
        "level" : "A2",
        "created_at" : "2014-10-31T18:21:15.000Z",
        "character": {
            "id" : 3,
            "location" : [0, 0],
            "img" : "https://res.cloudinary.com/builtquick/image/upload/v1594597582/avatar_qv7rjk.png",
            "forward" : "../images/forward.gif",
            "backward" : "../images/backward.gif",
            "up" : "../images/up.gif",
            "down" : "../images/down.gif",
            "success" : "../images/success.gif",
            "failure" : "../images/failure.gif"
        },
        "goal" : {
            "id" : 2,
            "location": [[6, 0], [4, 0]],
            "img" : "https://res.cloudinary.com/builtquick/image/upload/v1594597582/goal_oq1aba.png"
        },
        "obstacle" : {
            "id" : 0,
            "img" : "https://res.cloudinary.com/builtquick/image/upload/v1594597581/tile_e01hvh.png"
        },
        "path" : {
            "id": 1,
            "img" : "https://res.cloudinary.com/builtquick/image/upload/v1594598713/path_scyovz.png"
        },
        "background" : "https://res.cloudinary.com/builtquick/image/upload/v1594597582/background_vmgo7l.png",
        "instruction" : "Can you add just a few blocks to help me solve a more complex maze? If you do it right, I can walk any curvy path no matter the length. Hurry! The ice is melting!",
        "maze" : [[1, 1, 1, 1, 1, 1, 1, 0], [0, 0, 0, 0, 0, 0, 0, 0], [0, 0, 0, 0, 0, 0, 0, 0], [0, 0, 0, 0, 0, 0, 0, 0], [0, 0, 0, 0, 0, 0, 0, 0], [0, 0, 0, 0, 0, 0, 0, 0], [0, 0, 0, 0, 0, 0, 0, 0], [0, 0, 0, 0, 0, 0, 0, 0]], 
        "toolbox" : [
            {
                name: 'Actions',
                colour: '#5C81A6',
                blocks: [
                { type: 'move_forward' },
                { type: 'move_backward' },
                { type: 'move_up' },
                { type: 'move_down' }
                ],
            },
        ],
    }
];

export default exercises;