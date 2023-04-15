import { DynamoDBStore, Store } from './stores';
class Spackle {
  public apiKey: string;

  public apiBase: string = 'https://api.spackle.so/v1';
  public store: Store | null = null;
  public schemaVersion: number = 1;

  constructor(apiKey: string) {
    this.apiKey = apiKey;
  }

  async bootstrap() {
    if (!this.store) {
      this.store = new DynamoDBStore(this);
    }
  }
}

export default Spackle