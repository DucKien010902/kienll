class EmailService {
  constructor() {
    if (!EmailService.instance) {
      this.email = null;
      EmailService.instance = this;
    }
    return EmailService.instance;
  }

  setEmailGlobal(email) {
    console.log('day la email toan cuc: ' + email);
    this.email = email;
  }

  getEmail() {
    return this.email;
  }
}

const emailService = new EmailService();
export default emailService;
