package br.com.roxcom.ifsul.calculadorasimples;

import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;

import androidx.activity.EdgeToEdge;
import androidx.appcompat.app.AppCompatActivity;
import androidx.core.graphics.Insets;
import androidx.core.view.ViewCompat;
import androidx.core.view.WindowInsetsCompat;

import java.util.ArrayList;

public class MainActivity extends AppCompatActivity {
    TextView txtDisplay;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        EdgeToEdge.enable(this);
        setContentView(R.layout.activity_main);
        ViewCompat.setOnApplyWindowInsetsListener(findViewById(R.id.main), (v, insets) -> {
            Insets systemBars = insets.getInsets(WindowInsetsCompat.Type.systemBars());
            v.setPadding(systemBars.left, systemBars.top, systemBars.right, systemBars.bottom);
            return insets;
        });

        txtDisplay = findViewById(R.id.txtResult);
    }

    String operation = "";

    public void clickBtnOp(View view) {
        operation = ((Button) view).getText().toString();
    }

    public void clickBtnEquals(View view) {
        double v1 = Double.parseDouble(((EditText) findViewById(R.id.etNumber1)).getText().toString());
        double v2 = Double.parseDouble(((EditText) findViewById(R.id.etNumber2)).getText().toString());

        String result = "";
        switch (operation) {
            case "+": result = String.valueOf(Calculadora.add(v1, v2));
                break;
            case "-": result = String.valueOf(Calculadora.minus(v1, v2));
                break;
            case "*": result = String.valueOf(Calculadora.mult(v1, v2));
                break;
            case "/": result = String.valueOf(Calculadora.div(v1, v2));
                break;
        }

        txtDisplay.setText(result);
    }

    public void openCalc2(View view) {
        Intent it = new Intent(this, MainActivity2.class);
        startActivity(it);
    }
}