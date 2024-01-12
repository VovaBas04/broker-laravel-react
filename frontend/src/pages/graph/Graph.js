import Container from "@mui/material/Container";
import Typography from "@mui/material/Typography";
import Grid from "@mui/material/Grid";
import GraphViews from "./graph-views";
import Navigator from "../../component/Navigator";
import Header from "../../component/Header";
import {useEffect, useState} from "react";
import {useParams} from "react-router-dom";
import {Table, TableHead} from "@mui/material";
import TableCell from "@mui/material/TableCell";
import TableRow from "@mui/material/TableRow";
import {echo} from "../../App";
// import {store} from "../../redux";
export default function Graph() {
    const [data, setData] = useState([])
    const [name, setName] = useState("")
    let {id} = useParams()
    let [stocks, setStocks] = useState([]);
    useEffect(() => {
        echo.channel('emulator-date')
            .listen('DateUpdated', (event) => {
                console.log(event.date)
            });
    }, []);
    useEffect(() => {
        fetch(process.env.REACT_APP_API_URL+`stocks/${id}`, {
            method: "GET",
            mode: "cors"
        }).then(
            res => res.json()
        ).then(
            (dataAny) => {
                setData(dataAny.priceDate)
                setStocks(dataAny.priceDate)
                setName(dataAny.company)
            })
    }, [data.length])
    return (
        <Container maxWidth="xl">
            <Typography variant="h4" sx={{ mb: 5 }}>
                График акций
            </Typography>
            <Grid container spacing={3}>

                <Grid xs={12} md={6} lg={8}>
                    <GraphViews
                        title={name}
                        subheader="Стоимость в долларах"
                        chart={{
                            labels: stocks.map(item=>item.date),//stocks.map(item=>item.date.substring(3,5)+'/'+item.date.substring(0,2)+'/'+'20'+item.date.substring(6)),
                            series: [
                                {
                                    name: name,
                                    type: 'line',
                                    fill: 'solid',
                                    data: stocks.map(item=>item.price)
                                },
                            ],
                        }}
                    />
                </Grid>

            </Grid>
            <Table>
                <TableHead>
                    <TableCell>Дата</TableCell>
                    <TableCell>Цена</TableCell>
                </TableHead>
                {stocks.map((item)=>
                <TableRow hover tabIndex={-1} role="checkbox">
                    <TableCell>{item.date}</TableCell>
                    <TableCell>{item.price}</TableCell>
                </TableRow>
            )}
            </Table>
        </Container>
    );
}
