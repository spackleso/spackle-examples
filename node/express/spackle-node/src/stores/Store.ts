interface Store {
  getCustomerData(customerId: string): Promise<any>;
  setCustomerData(customerId: string, data: any): Promise<void>;
}

export default Store;