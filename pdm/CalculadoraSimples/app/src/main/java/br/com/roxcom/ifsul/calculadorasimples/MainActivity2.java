package br.com.roxcom.ifsul.calculadorasimples;

import android.annotation.SuppressLint;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;

import androidx.activity.EdgeToEdge;
import androidx.appcompat.app.AppCompatActivity;
import androidx.core.graphics.Insets;
import androidx.core.view.ViewCompat;
import androidx.core.view.WindowInsetsCompat;

import java.util.ArrayList;
import java.util.List;
import java.util.Objects;

public class MainActivity2 extends AppCompatActivity {
    TextView txtDisplay;
    TextView txtExpression;

    private String getDisplayText() {
        return txtDisplay.getText().toString();
    }

    private String getExpressionText() {
        return txtExpression.getText().toString();
    }

    @SuppressLint("SetTextI18n")
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        EdgeToEdge.enable(this);
        setContentView(R.layout.activity_main2);
        ViewCompat.setOnApplyWindowInsetsListener(findViewById(R.id.main2), (v, insets) -> {
            Insets systemBars = insets.getInsets(WindowInsetsCompat.Type.systemBars());
            v.setPadding(systemBars.left, systemBars.top, systemBars.right, systemBars.bottom);
            return insets;
        });

        ArrayList<Object> expression = new ArrayList<>();

        txtDisplay = findViewById(R.id.txtResult2);
        txtExpression = findViewById(R.id.txtExpression);

        class NumbersClickListener implements View.OnClickListener {
            @Override
            public void onClick(View v) {
                String txt = ((Button) v).getText().toString();

                if (getDisplayText().equals("0,00")) txtDisplay.setText("");
                if (getDisplayText().contains(".") && txt.equals(".")) return;

                txtDisplay.setText(getDisplayText() + txt);
                txtExpression.setText(txtExpression.getText().toString() + txt);
            }
        }

        class OperationsClickListener implements View.OnClickListener {
            @Override
            public void onClick(View v) {
                String op = ((Button) v).getText().toString();

                expression.add(Double.parseDouble(getDisplayText()));
                expression.add(op);

                txtDisplay.setText("");
                txtExpression.setText(getExpressionText() + " " + op + " ");
            }
        }

        int[] num_ids = { R.id.btnOne, R.id.btnTwo, R.id.btnThree, R.id.btnFour, R.id.btnFive, R.id.btnSix, R.id.btnSeven, R.id.btnEight, R.id.btnNine, R.id.btnZero, R.id.btnDot };
        for (int id : num_ids) {
            findViewById(id).setOnClickListener(new NumbersClickListener());
        }

        int[] ope_ids = { R.id.btnAdd2, R.id.btnMinus2, R.id.btnMult2, R.id.btnDiv2 };
        for (int id : ope_ids) {
            findViewById(id).setOnClickListener(new OperationsClickListener());
        }

        findViewById(R.id.btnDel).setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                if (!getDisplayText().isEmpty()) {
                    txtDisplay.setText(getDisplayText().substring(0, getDisplayText().length() - 1));
                    txtExpression.setText(getExpressionText().substring(0, getExpressionText().length() - 1));
                }
            }
        });

        findViewById(R.id.btnEquals2).setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                if (expression.size() < 2 || expression.size() % 2 != 0) return;

                expression.add(Double.parseDouble(txtDisplay.getText().toString()));

                double result = Calculadora.eval(expression);

                txtDisplay.setText("" + result);
                txtExpression.setText(getExpressionText() + " = " + result);

                expression.clear();
            }
        });

        findViewById(R.id.btnClear).setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                txtDisplay.setText("");
                txtExpression.setText("");
                expression.clear();
            }
        });
    }
}