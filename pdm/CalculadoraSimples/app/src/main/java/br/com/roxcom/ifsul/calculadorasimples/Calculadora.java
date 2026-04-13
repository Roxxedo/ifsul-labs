package br.com.roxcom.ifsul.calculadorasimples;

import java.util.List;

public class Calculadora {
    public static double add(double value1, double value2) {
        return value1 + value2;
    }

    public static double minus(double value1, double value2) {
        return value1 - value2;
    }

    public static double mult(double value1, double value2) {
        return value1 * value2;
    }

    public static double div(double value1, double value2) {
        return value1 / value2;
    }

    public static double eval(List<Object> expr) {
        if (expr.size() < 3 || expr.size() % 2 == 0) {
            throw new Error("Expressao Invalida");
        }

        double result = ((Number) expr.get(0)).doubleValue();

        for (int i = 1; i < expr.size(); i += 2) {
            String op = (String) expr.get(i);
            double next = ((Number) expr.get(i + 1)).doubleValue();

            switch (op) {
                case "+": {
                    result = result + next;
                    break;
                }
                case "-": {
                    result = result - next;
                    break;
                }
                case "*": {
                    result = result * next;
                    break;
                }
                case "/": {
                    result = result / next;
                    break;
                }
                default: {};
            }
        }

        return result;
    }
}
