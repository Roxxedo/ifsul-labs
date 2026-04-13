import java.util.List;

public class SalaDeAula {
    private String identificador;
    private Turma turmaPresente;
    private List<Aluno> alunosEmSala;

    public SalaDeAula(String identificador, Turma turmaPresente) {
        this.identificador = identificador;
        this.turmaPresente = turmaPresente;
    }

    public SalaDeAula(String identificador, Turma turmaPresente, List<Aluno> alunosEmSala) {
        this.identificador = identificador;
        this.turmaPresente = turmaPresente;
        this.alunosEmSala = alunosEmSala;
    }

    public String getIdentificador() {
        return identificador;
    }

    public Turma getTurmaPresente() {
        return turmaPresente;
    }

    public List<Aluno> getAlunosEmSala() {
        return alunosEmSala;
    }

    public void setIdentificador(String identificador) {
        this.identificador = identificador;
    }

    public void setTurmaPresente(Turma turmaPresente) {
        this.turmaPresente = turmaPresente;
    }

    public void addAluno(Aluno aluno) {
        this.alunosEmSala.add(aluno);
    }

    public void removerAluno(Aluno aluno) {
        this.alunosEmSala.remove(aluno);
    }
}
