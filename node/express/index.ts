import express, { Express, Request, Response } from 'express';
import dotenv from 'dotenv';
import path from 'path';
import Spackle from 'spackle-node';
import bodyParser from 'body-parser';

dotenv.config();

const app: Express = express();
app.use(bodyParser.urlencoded({ extended: true }));
app.use(bodyParser.json());

const port = process.env.PORT;

app.get('/', (req: Request, res: Response) => {
  res.sendFile(path.resolve(__dirname + '/../templates/index.html'));
});

app.post('/customers', async (req: Request, res: Response) => {
  const spackle = new Spackle(req.body.api_key);
  const start = Date.now();
  const customer = await spackle.customers.retrieve(req.body.customer_id);
  const end = Date.now();
  res.json({
    time: (end - start) / 1000,
    customer: customer.data,
  });
});

app.post('/pricing-table', async (req: Request, res: Response) => {
  const spackle = new Spackle(req.body.api_key);
  const table = await spackle.pricingTables.retrieve(req.body.pricing_table_id);
  res.json(table);
});

app.listen(port, async () => {
  console.log(`⚡️[server]: Server is running at http://localhost:${port}`);
});