import Header from "../../component/Header";
import Navigator from "../../component/Navigator";
import {theme} from "../../component/styles/theme";
import {ThemeProvider} from '@mui/material/styles';
import Button from "@mui/material/Button";
import Iconify from "../../component/Iconify";
import Link from "@mui/material/Link";
import AppBar from "@mui/material/AppBar";
import * as React from "react";
import Paper from "@mui/material/Paper";
import {Input, InputLabel} from "@mui/material";
import {Label} from "@mui/icons-material";
import FormControlLabel from "@mui/material/FormControlLabel";
import {Form} from "react-router-dom";
import {useEffect, useLayoutEffect, useState} from "react";
import Typography from "@mui/material/Typography";
import Grid from "@mui/material/Grid";
import Box from "@mui/material/Box";
// import {store} from "../../redux";
export default class Settings extends React.Component{
    constructor(props) {
        super(props);
        this.state ={
            setting: {
            }
        }
        this.edit = this.edit.bind(this);
    }
    componentDidMount() {
        fetch(process.env.REACT_APP_API_URL+'setting', {
            method: 'GET',
            mode: "cors",

        }).then(res => res.json())
            .then(data => {
                this.state.setting = {
                    firstDay: data.firstDay,
                    speed: data.speed
                }
            }).then(() => {
            console.log("Дата", this.state.setting.firstDay, this.state.setting.speed)
            this.forceUpdate()
        })
    }
    start(){
        // store.getState().socket.emit('start')
    }
    edit(event){
        event.preventDefault()
        let form = new FormData(event.currentTarget)
        this.state.setting = {
            firstDay:form.get('firstDay'),
            speed:form.get('speed')
        }
        fetch(process.env.REACT_APP_API_URL+'setting',{
            method:'PUT',
            mode:"cors",
            headers:{
                'Content-Type':'application/json'
            },
            body:JSON.stringify({
                firstDay:form.get('firstDay'),
                speed:form.get('speed')
            })
        }).then((data)=>{
            this.forceUpdate()
        })
    }
    render() {
        return (
            <ThemeProvider theme={theme}>
                <Header></Header>
                <Navigator></Navigator>
                <Paper sx={{maxWidth: 936, margin: 'auto', overflow: 'hidden'}}>
                    {/*<Button variant="contained" color="inherit" startIcon={<Iconify icon="eva:plus-fill" />}>*/}
                    {/*</Button>*/}
                    <AppBar
                        position="static"
                        color="default"
                        elevation={0}
                        sx={{borderBottom: '1px solid rgba(0, 0, 0, 0.12)'}}
                    >
                    </AppBar>
                    <Box component="form" onSubmit={this.edit} sx={{ mt: 3 }}>
                    <InputLabel>Дата начала торгов</InputLabel>
                    <Input type="date" sx={{margin: 1}} required={true} name="firstDay"></Input>
                    <InputLabel>Скорость смены дат(в секундах) </InputLabel>
                    <Input type="number" sx={{margin: 1}} required={true} name="speed"></Input>
                    <Button type="submit">Изменить</Button>
                    </Box>
                    <Button sx={{marginTop: 20}} variant="contained" color="primary" onClick={this.start}>
                        Начать торги
                    </Button>
                    <Typography>Текущая дата и скорость</Typography>
                    <Typography>{this.state.setting.firstDay}</Typography>
                    <Typography>{this.state.setting.speed} </Typography>
                </Paper>
            </ThemeProvider>
        )
    }
}
