import java.util.ArrayList;
import java.util.List;

public class Turma {
    private String identificador;

    private int capacidadeMaxima;

    private Curso curso;

    private List<Aluno> alunos = new ArrayList<>();

    public Turma(String identificador, int capacidadeMaxima, Curso curso) {
        this.identificador = identificador;
        this.capacidadeMaxima = capacidadeMaxima;
        this.curso = curso;
    }

    public Turma(String identificador, int capacidadeMaxima, Curso curso, List<Aluno> alunos) {
        this.identificador = identificador;
        this.capacidadeMaxima = capacidadeMaxima;
        this.curso = curso;
        this.alunos = alunos;
    }

    public String getIdentificador() {
        return identificador;
    }

    public int getCapacidadeMaxima() {
        return capacidadeMaxima;
    }

    public Curso getCurso() {
        return curso;
    }

    public List<Aluno> getAlunos() {
        return alunos;
    }

    public void setIdentificador(String identificador) {
        this.identificador = identificador;
    }

    public void setCapacidadeMaxima(int capacidadeMaxima) {
        this.capacidadeMaxima = capacidadeMaxima;
    }

    public void setCurso(Curso curso) {
        this.curso = curso;
    }

    public void addAluno(Aluno aluno) {
        this.alunos.add(aluno);
    }
}
