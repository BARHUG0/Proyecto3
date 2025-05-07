import React, {useEffect, useState} from "react";
import api from '../services/api';


const ReportableTable = () => {
    const [data, setData] = useState([]);

    useEffect(()=> {
        api.get('/get-reporte-pinturas.php')
        .then(res => setData(res.data))
        .catch(err => console.error(err));
    }, []);

    return (
        <table>
          <thead>
            <tr>
              <th>ID</th>
              <th>Título</th>
              <th>Artista</th>
              <th>Precio</th>
            </tr>
          </thead>
          <tbody>
            {data.map(painting => (
              <tr key={painting.id}>
                <td>{painting.id}</td>
                <td>{painting.title}</td>
                <td>{painting.artist_name}</td>
                <td>{painting.price}</td>
              </tr>
            ))}
          </tbody>
        </table>
      );


};


export default ReportableTable;