# BURROUGHS_TEST

**Business Requirements:**

The company’s payroll system gives Sales staff two payments every month. They receive a regular
fixed base monthly salary, plus a monthly bonus, with the following rules for their issuing dates:

	● The base salaries are paid on the last day of the month, unless that day is a Saturday or a
	Sunday (weekend). In that case, salaries are paid on the Friday before the weekend.

	● On the 15th of every month bonuses are paid for the previous month, unless that day is a
	weekend. In that case, they are paid the first Wednesday after the 15th.

	● For the sake of this challenge, please do not take into account public holidays.
Functional Requirements
The Administration Department currently needs the output of the utility to be a CSV file,
containing the payment dates for the next twelve months, starting with the current month. The
CSV file should contain the following columns:

	● the month name
	● the salary payment date for that month
	● the bonus payment date for the previous month.

The output file name should be provided as an argument to the CLI command.
